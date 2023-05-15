<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\View\HomeController;
use App\Http\Controllers\View\MatchgameViewController;
use App\Http\Controllers\View\TicketViewController;
use App\Http\Controllers\View\ZoneViewController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
    Route::group(['prefix' => 'tickets'], function ($router) {
        Route::get('index', [TicketViewController::class, 'index'])->name('tickets.index');
        Route::post('store', [TicketViewController::class, 'store'])->name('tickets.store');
        Route::delete('delete/{ticketId}', [TicketViewController::class, 'delete'])->name('tickets.delete');
        Route::put('update/{ticketId}', [TicketViewController::class, 'update'])->name('tickets.update');
        Route::get('edit/{ticketId}', [TicketViewController::class, 'showEditPage'])->name('tickets.edit');
        Route::get('create', [TicketViewController::class, 'showCreatePage'])->name('tickets.create');
        Route::get('matchgametickets', [TicketViewController::class, 'matchgameTickets'])->name('tickets.matchgameTickets');
    });
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

    Route::group(['prefix' => 'zones'], function ($router) {
        Route::get('index', [ZoneViewController::class, 'index'])->name('zones.index');
        Route::get('stadiumZones', [ZoneViewController::class, 'getStadiumZones'])->name('zones.stadiumZones');
        Route::get('edit/{zoneId}', [ZoneViewController::class, 'showEditPage'])->name('zones.edit');
        Route::put('update/{zoneId}', [ZoneViewController::class, 'update'])->name('zones.update');
    });
});

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
