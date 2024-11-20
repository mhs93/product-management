<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\GameController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

Route::post('product-store',[ProductController::class,'store'])->name('product.store');

Route::get('images',[ImageUploadController::class,'index'])->name('images');
Route::post('image-store',[ImageUploadController::class,'store'])->name('image.store');

Route::get('games', [GameController::class, 'index'])->name('game.list');
Route::get('games/ajax', [GameController::class, 'fetchGames'])->name('game.ajax.list');

