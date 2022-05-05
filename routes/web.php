<?php

use App\Http\Controllers\Admin\GameAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//game
Route::get('game-index', [GameAdminController::class, 'index'])->name('game-index');
Route::post('game-post', [GameAdminController::class, 'add'])->name('game-post');
