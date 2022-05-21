<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\TopUpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('auth', [AuthController::class, 'auth']);

    //topup
    Route::get('topup-list', [TopUpController::class, 'all']);
    Route::post('topup', [TopUpController::class, 'topUp']);
    Route::post('upload-bukti', [TopUpController::class, 'upload']);

    //Game
    Route::get('game', [GameController::class, 'gameList']);
    Route::post('product-list', [GameController::class, 'product']);
});
