<?php

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
});

// Routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});
