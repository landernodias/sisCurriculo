<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Users Routes
//Administrativo
Route::middleware(['auth', 'user-access:administrativo'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});

// Gestor Routes

Route::middleware(['auth', 'user-access:gestor'])->group(function () {

    Route::get('/manager/dashboard', [HomeController::class, 'managerDashboard'])->name('manager.dashboard');
});
