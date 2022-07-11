<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;

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

Route::get('/', [PageController::class, 'index']);
Route::get('/contacts', [PageController::class, 'contacts']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/catalog', [PageController::class, 'catalog']);
Route::get('/product/{id}', [PageController::class, 'product']);
Route::get('/category/{id}', [PageController::class, 'category']);
Route::get('/search/{q}', [PageController::class, 'search']);
Route::get('/cart', [PageController::class, 'cart']);

Route::get('/session', [CartController::class, 'dump']);
