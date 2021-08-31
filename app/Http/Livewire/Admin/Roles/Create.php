<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Http\Livewire\Admin\Component;
use App\Models\Admin\Permission;
use App\Models\Admin\PermissionsGroup;
use App\Models\Admin\Role;

class Create extends Component
{

    /** @var string $name */
    public string $name = '';

    /** @var string $guard_name */
    public string $guardName = 'web';

    /** @var bool $selectAllPermissions */
    public bool $selectAllPermissions = false;

    /** @var array $permissions */
    public array $selectedPermissions = [];

    /** @var array $permissions */
    public $permissions = [];

    /** @var Role|null $role */
    public ?Role $role = null;

    /** @var array $inputs */
    public array $inputs = [];

    /**
     * @var array|\string[][]
     */
    protected array $rules = [
        'name' => ['required', 'max:255'],
        'guardName' => ['required'],
        'inputs.*.display_name' => ['required'],
        'inputs.*.description' => ['required'],
    ];

    public function mount()
    {
        if ($this->role) {
            $this->guardName = $this->role->guard_name;
            $this->name = $this->role->name;
            $this->setSelectedPermissions();

            foreach (getSupportedLanguagesKeys() as $locale) {
                $this->inputs[$locale]['display_name'] = $this->role->getTranslations()['display_name'][$locale];
                $this->inputs[$locale]['description'] = $this->role->getTranslations()['description'][$locale];
            }
        }

        $this->permissions = $this->getPermissionsByGuard($this->guardName);

        $this->toggleSelectAllCheck();
    }

    /**
     * If all permissions are selected then mark "Select All" as checked.
     */
    public function toggleSelectAllCheck()
    {
        $this->selectAllPermissions = count($this->permissions) == count($this->selectedPermissions);
    }

    public function setSelectedPermissions()
    {
        $this->selectedPermissions = collect($this->role->permissions()->pluck('id'))->all();
    }

    /**
     * Switch permissions list based on guard name.
     *
     * @param $value
     */
    public function permissionsBySelectedGuard($value)
    {
        if (count($this->getPermissionsByGuard($value))) {
            if ($this->role) {
                $this->setSelectedPermissions();
            }

            $this->permissions = $this->getPermissionsByGuard($value);
        } else {
            $this->permissions = [];
            $this->selectedPermissions = [];
            $this->selectAllPermissions = false;
        }

        $this->toggleSelectAllCheck();
    }

    /**
     * Select all permissions.
     *
     * @param $value
     */
    public function updatedSelectAllPermissions($value)
    {
        $this->selectedPermissions = $value ? collect(Permission::pluck('id'))->all() : [];
    }

    public function getPermissionsByGuard($guard)
    {
        return PermissionsGroup::whereRelation('permissions', 'guard_name', $guard)->get();
    }

    public function buildTranslatedFields($column): array
    {
        return collect(getSupportedLanguagesKeys())->map(function ($localeCode) use ($column) {
            return [$localeCode => $this->inputs[$localeCode][$column]];
        })->collapse()->all();
    }

    public function save()
    {
        $this->resetErrorBag();

        $this->validate();

        if (!$this->role) {
            if (!isRoleExist($this->name, $this->guardName)) {
                $role = Role::create([
                    'name' => $this->name,
                    'display_name' => $this->buildTranslatedFields('display_name'),
                    'description' => $this->buildTranslatedFields('description'),
                    'guard_name' => $this->guardName
                ]);

                if (count($this->selectedPermissions) > 0) {
                    $role?->syncPermissions($this->selectedPermissions);
                }

                session()->flash('success', __('admin/crud.roles.create.messages.success'));
                return redirect()->route('admin.roles');
            } else {
                session()->flash('danger', __('admin/crud.roles.create.messages.exists', ['name' => $this->name]));
            }
        } else {
            $role = Role::findByName($this->name, $this->guardName);

            $role->update([
                'name' => $this->name,
                'display_name' => $this->buildTranslatedFields('display_name'),
                'description' => $this->buildTranslatedFields('description'),
                'guard_name' => $this->guardName
            ]);

            if (count($this->selectedPermissions) > 0) {
                $role?->syncPermissions($this->selectedPermissions);
            }

            session()->flash('success', __('admin/crud.roles.edit.messages.success'));
            return redirect()->route('admin.roles');
        }
    }

    public function render()
    {
        $roles = Role::all();

        return view('livewire.admin.roles.create', compact('roles'));
    }
}
