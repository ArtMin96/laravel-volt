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
    public string $guard_name = '';

    /** @var array $display_name */
    public array $display_name = [];

    /** @var bool $selectAllPermissions */
    public bool $selectAllPermissions = false;

    /** @var array $permissions */
    public array $selectedPermissions = [];

    /**
     * @var array|\string[][]
     */
    protected array $rules = [
        'name' => ['required', 'max:255'],
        'guard_name' => ['required'],
        'display_name.*' => ['required']
    ];

    /**
     * @param $value
     */
    public function updatedSelectAllPermissions($value)
    {
        $this->selectedPermissions = $value ? collect(Permission::pluck('id'))->all() : [];
    }

    public function save()
    {
        $this->validate();

        $role = Role::create([
            'name' => $this->name,
            'display_name' => collect($this->display_name)->all(),
            'guard_name' => $this->guard_name
        ]);

        $role?->syncPermissions($this->selectedPermissions);

        return redirect()
    }

    public function render()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('livewire.admin.roles.create', compact('roles', 'permissions'));
    }
}
