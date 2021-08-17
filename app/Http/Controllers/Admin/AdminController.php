<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Admin\Role;
use App\Repository\Admin\AdminRepositoryInterface;
use App\Traits\Admin\Authorizable;

class AdminController extends Controller
{
    use Authorizable;

    private AdminRepositoryInterface $adminRepository;

    /**
     * @param AdminRepositoryInterface $adminRepository
     */
    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function index()
    {
        return view('admin.admins.index');
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');

        return view('admin.admins.create', compact('roles'));
    }

    /**
     * @param Admin $admin
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }
}
