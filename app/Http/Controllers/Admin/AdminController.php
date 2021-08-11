<?php

namespace App\Http\Controllers\Admin;

use App\Repository\Admin\AdminRepositoryInterface;

class AdminController extends Controller
{
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
        $admins = $this->adminRepository->all();

        return view('admin.admins.index', compact('admins'));
    }
}
