<?php

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

Route::get('/', function () {return redirect('/login');});
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::get('/home', [App\Http\Controllers\Auth\HomeController::class, 'index'])->name('home');
Route::post('/logout', [App\Http\Controllers\Auth\HomeController::class, 'logout'])->name('logout');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Route::post('/tickets', [App\Http\Controllers\Auth\TicketViewController::class, 'index'])->name('tickets');
Route::post('/matchs', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('matchs');
Route::post('/zones', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('zones');

