<?php

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
        });
    });

});
