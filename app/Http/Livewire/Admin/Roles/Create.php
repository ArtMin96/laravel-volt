<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use Livewire\Component;

class Create extends Component
{
    /** @var string $name */
    public string $name = '';

    /** @var string $guard_name */
    public string $guardName = 'web';

    /** @var array $display_name */
    public array $display_name = [];

    /** @var bool $selectAllPermissions */
    public bool $selectAllPermissions = false;

    /** @var array $permissions */
    public array $selectedPermissions = [];

    /** @var array $permissions */
    public $permissions = [];

    public ?Role $role = null;

    public array $inputs = [];

    /**
     * @var array|\string[][]
     */
    protected array $rules = [
        'name' => ['required', 'max:255'],
        'guardName' => ['required'],
        'inputs.*.display_name' => ['required']
    ];

    public function mount()
    {
        if ($this->role) {
//            dd($this->role->getTranslations());
            $this->guardName = $this->role->guard_name;
            $this->name = $this->role->name;
            $this->selectedPermissions = collect($this->role->permissions()->pluck('id'))->all();
            dd($this->inputs);
            foreach (getSupportedLanguagesKeys() as $locale) {
                dd($this->display_name[$locale]);
            }

            dd($this->role->display_name);
        }

        $this->permissions = $this->getPermissionsByGuard($this->guardName);
    }

    /**
     * Switch permissions list based on guard name.
     *
     * @param $value
     */
    public function permissionsByGuard($value)
    {
        if (count($this->getPermissionsByGuard($value))) {
            $this->permissions = $this->getPermissionsByGuard($value);
        } else {
            $this->permissions = [];
            $this->selectedPermissions = [];
            $this->selectAllPermissions = false;
        }
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
        return Permission::where('guard_name', $guard)->get();
    }

    public function save()
    {
        $this->validate();

        if (!isRoleExist($this->name, $this->guardName)) {
            $role = Role::create([
                'name' => $this->name,
                'display_name' => collect($this->display_name)->all(),
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
    }

    public function render()
    {
        $roles = Role::all();

        return view('livewire.admin.roles.create', compact('roles'));
    }
}
