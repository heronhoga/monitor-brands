<?php

use App\Http\Controllers\DashboardControllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControllers;

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

// Routes for guests (unauthenticated users)
Route::middleware('guest')->group(function () {
    Route::get('/', [HomeControllers::class, 'index']);
    Route::get('/login', [HomeControllers::class, 'loginPage'])->name('login');
    Route::post('/login', [HomeControllers::class, 'login'])->name("login-action");
});

// Routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardControllers::class, 'index'])->name('dashboard');
    Route::get('/logout', [HomeControllers::class, 'logout'])->name('logout');

    //CREATE BRAND ROUTES
    Route::get('/create-brand', [DashboardControllers::class, 'createBrandIndex'])->name('create-brand');
    Route::post('/create-brand', [DashboardControllers::class, 'createBrand'])->name('create-brand-action');

    //EDIT BRAND ROUTES
    Route::get('/edit-brand/{id_brand}', [DashboardControllers::class, 'editBrandIndex'])->name('edit-brand');
    Route::put('/edit-brand/{id_brand}', [DashboardControllers::class, 'editBrand'])->name('edit-brand-action');

    //DELETE BRAND ROUTES
    Route::delete('/delete-brand/{id_brand}', [DashboardControllers::class, 'deleteBrand'])->name('delete-brand-action');

});
