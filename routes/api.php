<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JogoDaVelhaController;

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

Route::get('/jogo-da-velha', function () {
});
Route::post('/jogo-da-velha', [JogoDaVelhaController::class, 'index']);
Route::post('/jogo-da-velha-autenticacao', [JogoDaVelhaController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('player', App\Http\Controllers\PlayerController::class);

Route::post('game/create', [App\Http\Controllers\GameController::class, 'createGame'])->name('game.create');
Route::post('game/move', [App\Http\Controllers\GameController::class, 'createMove'])->name('game.move');

Route::get('teste', function () {
    return response(\App\Models\Player::all());
});

