<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
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

Route::post('/tickets', [App\Http\Controllers\Auth\TicketViewController::class, 'index'])->middleware('auth')->name('tickets');
Route::get('/tickets', [App\Http\Controllers\Auth\TicketViewController::class, 'index'])->middleware('auth')->name('tickets');
Route::post('/matchs', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('matchs');
Route::post('/zones', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('zones');

Route::delete('/tickets/{ticket}', [App\Http\Controllers\Auth\TicketViewController::class, 'delete'])->name('tickets.delete');

Route::put('/tickets/{ticket}', [App\Http\Controllers\Auth\TicketViewController::class, 'update'])->name('tickets.update');

Route::post('/tickets', [App\Http\Controllers\Auth\TicketViewController::class, 'store'])->name('tickets.store');


Route::get('show/{matchgameId}', [\App\Http\Controllers\Auth\TicketViewController::class, 'showZonesByMatchGameID']);

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

