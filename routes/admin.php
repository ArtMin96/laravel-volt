<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Livewire\Admin\Auth\Login;
use App\Http\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::prefix('/admin')->name('admin.')->group(function () {

        Route::middleware('guest:admin')->group(function () {
            Route::get('login', Login::class)
                ->name('login');
        });

        Route::middleware('auth:admin')->group(function () {
            Route::get('dashboard', Dashboard::class)->name('dashboard');

            Route::get('profile')->name('profile');

            Route::post('logout', LogoutController::class)->name('logout');

            // Admin user management routes
            Route::get('admins', [AdminController::class, 'index'])->name('admins');
            Route::get('admins/create', [AdminController::class, 'create'])->name('admins.create');

            // User management routes
            Route::get('users', [UserController::class, 'index'])->name('user');

            // Role management routes
            Route::get('roles', [RoleController::class, 'index'])->name('roles');
            Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');

            // Permission management routes
            Route::get('permission', [PermissionController::class, 'index'])->name('permission');
        });
    });

});
