<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\TicketViewController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
    Route::get('/tickets', [TicketViewController::class, 'index'])->name('tickets');
    Route::post('/tickets', [TicketViewController::class, 'store'])->name('tickets.store');
    Route::delete('/tickets/{ticket}', [TicketViewController::class, 'delete'])->name('tickets.delete');
    Route::put('/tickets/update/{ticket}', [TicketViewController::class, 'update'])->name('tickets.update');
    Route::get('/show/{matchgameId}', [TicketViewController::class, 'showZonesByMatchGameID']);
    Route::get('/zone/all', [TicketViewController::class, 'showZones']);
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');



Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


//Unused
Route::post('/matchs', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('matchs');
Route::post('/zones', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('zones');
