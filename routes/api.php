<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\MessageUserController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductControllerUser;
use App\Http\Controllers\Api\SettingUserController;
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
    Route::post('changePass', [AuthController::class, 'changePass']);
    Route::get('getDataUser', [AuthController::class, 'getDataUser']);

    //topup
    Route::get('topup-list', [TopUpController::class, 'all']);
    Route::get('topup-allPending', [TopUpController::class, 'allPending']);
    Route::post('topup', [TopUpController::class, 'topUp']);
    Route::post('upload-bukti/{id}', [TopUpController::class, 'upload']);

    //Game
    Route::get('game', [GameController::class, 'gameList']);
    // Route::get('product-all', [GameController::class, 'productAll']);

    //product
    Route::post('detail-product', [ProductControllerUser::class, 'productDetail']);
    Route::post('detail-product-porto', [ProductControllerUser::class, 'getPortofolio']);
    Route::post('detail-product-getImage', [ProductControllerUser::class, 'getImage']);
    Route::post('product-review', [ProductControllerUser::class, 'addReview']);
    Route::post('product-list', [ProductControllerUser::class, 'product']);


    //order
    Route::post('make-order', [OrderApiController::class, 'makeOrder']);
    Route::get('list-order', [OrderApiController::class, 'orderList']);
    Route::post('detail-order', [OrderApiController::class, 'orderDetail']);

    //message
    Route::post('send-message', [MessageUserController::class, 'sendMessage']);
    Route::get('get-message', [MessageUserController::class, 'getMessage']);

    //setting
    Route::post('change-name', [SettingUserController::class, 'changeName']);
    Route::post('change-password', [SettingUserController::class, 'changePass']);
    Route::post('change-email', [SettingUserController::class, 'changeMail']);
});
