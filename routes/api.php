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
    Route::get('example', [App\Http\Controllers\MatchgameController::class, 'example']);
    Route::get('show/{matchgameId}', [App\Http\Controllers\MatchgameController::class, 'show']);
    Route::get('matchesby',[App\Http\Controllers\MatchgameController::class, 'matchesBy']);
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'team'
], function ($router) {
    Route::get('index', [App\Http\Controllers\TeamController::class, 'index']);
    Route::get('show/{teamId}', [App\Http\Controllers\TeamController::class, 'show']);
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'stadium'
], function ($router) {
    Route::get('index', [App\Http\Controllers\StadiumController::class, 'index']);
    Route::get('show/{stadiumId}', [App\Http\Controllers\StadiumController::class, 'show']);
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'ticket'
], function ($router) {
    Route::get('show/{ticketId}', [App\Http\Controllers\TicketController::class, 'show']);
    Route::get('matchtickets/{matchgameId}', [App\Http\Controllers\TicketController::class, 'matchTickets']); 
    Route::post('carttickets', [App\Http\Controllers\TicketController::class, 'getCartTickets']);   
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'zone'
], function ($router) {
    Route::get('show/{zoneId}', [App\Http\Controllers\ZoneController::class, 'show']);
    Route::get('stadiumzones/{stadiumId}', [App\Http\Controllers\ZoneController::class, 'stadiumZones']);
});

Route::group([
    'middleware' => ['api'],
    'prefix' => 'order'
], function ($router) {
    Route::post('checkout', [App\Http\Controllers\OrderController::class, 'checkOutOrder']);
});
