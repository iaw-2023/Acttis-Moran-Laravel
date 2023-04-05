<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'matchgame'
], function ($router) {
    Route::get('index', [App\Http\Controllers\MatchgameController::class, 'index']);
    Route::get('show/{id}', [App\Http\Controllers\MatchgameController::class, 'show']);
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'team'
], function ($router) {
    Route::get('index', [App\Http\Controllers\TeamController::class, 'index']);
    Route::get('show/{id}', [App\Http\Controllers\TeamController::class, 'show']);
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'stadium'
], function ($router) {
    Route::get('index', [App\Http\Controllers\StadiumController::class, 'index']);
    Route::get('show/{id}', [App\Http\Controllers\StadiumController::class, 'show']);
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'ticket'
], function ($router) {
    Route::get('index', [App\Http\Controllers\TicketController::class, 'index']);
    Route::get('show/{id}', [App\Http\Controllers\TicketController::class, 'show']);
    Route::get('matchtickets/{id}', [App\Http\Controllers\TicketController::class, 'matchTickets']);  
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'zone'
], function ($router) {
    Route::get('index', [App\Http\Controllers\ZoneController::class, 'index']);
    Route::get('show/{id}', [App\Http\Controllers\ZoneController::class, 'show']);
    Route::get('zonetickets/{id}', [App\Http\Controllers\ZoneController::class, 'zoneTickets']);
});
