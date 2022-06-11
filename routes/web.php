<?php

use App\Http\Controllers\Admin\GameAdminController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\ProductAdminCOntroller;
use App\Http\Controllers\Admin\TopupControllerAdmin;
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
Route::get('game-edit/{id}', [GameAdminController::class, 'editView'])->name('game-editView');
Route::get('game-delete/{id}', [GameAdminController::class, 'delete'])->name('game-delete');
Route::post('game-post', [GameAdminController::class, 'add'])->name('game-post');
Route::post('edit-post/{id}', [GameAdminController::class, 'edit'])->name('edit-post');

// product
Route::get('product-index', [ProductAdminCOntroller::class, 'index'])->name('product-index');
Route::get('product-edit/{id}', [ProductAdminCOntroller::class, 'view'])->name('product-editView');
Route::get('product-delete/{id}', [ProductAdminCOntroller::class, 'delete'])->name('product-delete');
Route::post('product-post', [ProductAdminCOntroller::class, 'add'])->name('product-post');
Route::post('edit-post/{id}/product', [ProductAdminCOntroller::class, 'store'])->name('edit-post-product');
Route::get('product-detail/{id}', [ProductAdminCOntroller::class, 'viewDetail'])->name('product-View');
Route::get('delete-portofolio/{id}', [ProductAdminCOntroller::class, 'deletePorto'])->name('delete-portofolio');
Route::post('add-portofolio/{id}', [ProductAdminCOntroller::class, 'portofolio'])->name('add-portofolio');

//topup
Route::get('topup-index', [TopupControllerAdmin::class, 'index'])->name('topup-index');
Route::get('topup-detail/{id}', [TopupControllerAdmin::class, 'view'])->name('topup-detail');
Route::get('topup-confirm/{id}', [TopupControllerAdmin::class, 'confirm'])->name('topup-confirm');

//order
Route::get('order-index', [OrderAdminController::class, 'index'])->name('order-index');
Route::get('order-detail/{id}', [OrderAdminController::class, 'detail']);
Route::post('change-status/{id}', [OrderAdminController::class, 'changeStatus'])->name('changeStatus');
