<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenyusutanController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('tologin');


Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['permission:dashboards']], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::group(['middleware' => 'role:ketua'], function () {
        Route::group(['middleware' => ['permission:users-list|users-create|users-edit|users-delete']], function () {
            Route::get('users', [UsersController::class, 'index'])->name('users');
            Route::get('users/add', [UsersController::class, 'create'])->name('users.add');
            Route::post('users', [UsersController::class, 'store'])->name('users.store');
            Route::get('users/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
            Route::post('users/update/{id}', [UsersController::class, 'update'])->name('users.update');
            Route::post('users/delete/{id}', [UsersController::class, 'destroy'])->name('users.delete');
        });
    });

    Route::group(['middleware' => 'role:ketua|bendahara|anggota'], function () {

        Route::group(['middleware' => ['permission:kategori-list|kategori-create|kategori-edit|kategori-delete']], function () {
            Route::get('kategori', [KategoriController::class, 'index'])->name('kategori');
            Route::get('kategori/add', [KategoriController::class, 'create'])->name('kategori.add');
            Route::post('kategori', [KategoriController::class, 'store'])->name('kategori.store');
            Route::get('kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
            Route::post('kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
            Route::post('kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.delete');
        });

        Route::group(['middleware' => ['permission:aset-list|aset-create|aset-edit|aset-delete']], function () {
            Route::get('aset', [AsetController::class, 'index'])->name('aset');
            Route::get('aset/add', [AsetController::class, 'create'])->name('aset.add');
            Route::post('aset', [AsetController::class, 'store'])->name('aset.store');
            Route::get('aset/edit/{id}', [AsetController::class, 'edit'])->name('aset.edit');
            Route::get('aset/show/{id}', [AsetController::class, 'show'])->name('aset.show');
            Route::post('aset/update/{id}', [AsetController::class, 'update'])->name('aset.update');
            Route::post('aset/delete/{id}', [AsetController::class, 'destroy'])->name('aset.delete');
        });

        Route::group(['middleware' => ['permission:penyusutan-list|penyusutan-create|penyusutan-edit|penyusutan-delete']], function () {
            Route::get('penyusutan', [PenyusutanController::class, 'index'])->name('penyusutan');
            Route::get('penyusutan/add', [PenyusutanController::class, 'create'])->name('penyusutan.add');
            Route::get('penyusutan/edit/{id}', [PenyusutanController::class, 'edit'])->name('penyusutan.edit');
            Route::post('penyusutan/update/{id}', [PenyusutanController::class, 'update'])->name('penyusutan.update');
        });

        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');
    });
});
