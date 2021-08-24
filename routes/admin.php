<?php

use App\Http\Controllers\Admin\{AdminController,
    InvitationController,
    PermissionController,
    RoleController,
    UserController};
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Livewire\Admin\Auth\Login;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Auth\Register;
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

            Route::get('register', Register::class)
                ->name('register');
        });

        Route::middleware('auth:admin')->group(function () {
            Route::get('dashboard', Dashboard::class)->name('dashboard');

            Route::get('profile')->name('profile');

            Route::post('logout', LogoutController::class)->name('logout');

            // Admin user management routes
            Route::get('admins', [AdminController::class, 'index'])->name('admins');

            Route::prefix('admins/')->name('admins.')->group(function () {
                Route::get('create', [AdminController::class, 'create'])->name('create');
                Route::get('edit/{admin}', [AdminController::class, 'edit'])->name('edit');

                // Admin invitation routes
                Route::get('invitation', [InvitationController::class, 'invitation'])->name('invitation');

                Route::prefix('invitation/')->name('invitation.')->group(function () {
//                    Route::get('edit/{admin}', [AdminController::class, 'edit'])->name('edit');
                });
            });

            // User management routes
            Route::get('users', [UserController::class, 'index'])->name('user');

            // Role management routes
            Route::get('roles', [RoleController::class, 'index'])->name('roles');
            Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
            Route::get('roles/edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');

            // Permission management routes
            Route::get('permission', [PermissionController::class, 'index'])->name('permission');
        });
    });

});
