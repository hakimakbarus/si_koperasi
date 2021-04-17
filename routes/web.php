<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'role:super admin']], function () {
    Route::get('superadmin/home', [App\Http\Controllers\HomeController::class, 'superadminHome'])->name('superadmin.home');
    Route::resource('superadmin/user', 'App\Http\Controllers\UserController');
    Route::resource('superadmin/madrasah', 'App\Http\Controllers\MadrasahController');
    Route::resource('superadmin/ribath', 'App\Http\Controllers\RibathController');
    Route::resource('superadmin/santri', 'App\Http\Controllers\SantriController');
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');
});

Route::group(['middleware' => ['auth', 'role:merchant']], function () {
    Route::get('merchant/home', [App\Http\Controllers\HomeController::class, 'merchantHome'])->name('merchant.home');
});

Route::group(['middleware' => ['auth', 'role:wali santri']], function () {
    Route::get('wali/home', [App\Http\Controllers\HomeController::class, 'waliHome'])->name('wali.home');
});

Route::group(['middleware' => ['auth', 'role:bendahara']], function () {
    Route::get('bendahara/home', [App\Http\Controllers\HomeController::class, 'bendaharaHome'])->name('bendahara.home');
});
