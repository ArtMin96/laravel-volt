<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use Livewire\Component;

class Create extends Component
{
    public string $name;

    public array $display_name;

    protected array $rules = [
        'name' => ['required', 'max:255'],
        'display_name.*' => ['required']
    ];

    public function save()
    {
        dd($this->display_name);
    }

    public function render()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('livewire.admin.roles.create', compact('roles', 'permissions'));
    }
}
