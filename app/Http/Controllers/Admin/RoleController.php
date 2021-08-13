<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.roles.create');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('admin.roles.edit', compact('role'));
    }
}
