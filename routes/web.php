<?php

use App\Http\Controllers\Frontend\Auth\LogoutController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Livewire\Frontend\Auth\Login;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('frontend.')->group(function () {
    Route::get('/', HomeController::class)->name('home');

    Route::middleware('guest')->group(function () {
        Route::get('login', Login::class)
            ->name('login');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', LogoutController::class)
            ->name('logout');
    });
});
