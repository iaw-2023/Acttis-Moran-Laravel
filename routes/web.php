<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\TicketViewController;
use App\Http\Controllers\Auth\MatchgameViewController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
    Route::get('/tickets', [TicketViewController::class, 'index'])->name('tickets');
    Route::post('/tickets', [TicketViewController::class, 'store'])->name('tickets.store');
    Route::delete('/tickets/{ticket}', [TicketViewController::class, 'delete'])->name('tickets.delete');
    Route::put('/tickets/update/{ticket}', [TicketViewController::class, 'update'])->name('tickets.update');
    Route::get('/show/{matchgameId}', [TicketViewController::class, 'showZonesByMatchGameID']);
    Route::get('/zone/all', [TicketViewController::class, 'showZones']);
    
    Route::group(['prefix' => 'matchgames'], function ($router) {
        Route::get('index', [MatchgameViewController::class, 'index'])->name('matchgames.index');
        Route::delete('delete/{matchgameId}', [MatchgameViewController::class, 'delete'])->name('matchgames.delete');
        Route::get('edit/{matchgameId}', [MatchgameViewController::class, 'showEditPage'])->name('matchgames.edit');
        Route::put('update/{matchgameId}', [MatchgameViewController::class, 'update'])->name('matchgames.update');
        Route::get('create', [MatchgameViewController::class, 'showCreatePage'])->name('matchgames.create');
        Route::post('store', [MatchgameViewController::class, 'store'])->name('matchgames.store');
    });
});

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
