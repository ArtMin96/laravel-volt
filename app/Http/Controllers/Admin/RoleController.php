<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use App\Traits\Admin\Authorizable;

class RoleController extends Controller
{
    use Authorizable;

    public function index()
    {
        return view('admin.roles.index');
    }

    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.roles.create', compact('roles', 'permissions'));
    }
}
