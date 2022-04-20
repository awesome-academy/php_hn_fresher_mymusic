<?php

use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
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
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout']);

    Route::middleware('api.admin')->group(function () {
        Route::resource('albums', AlbumController::class)->except(['create', 'edit']);
        Route::resource('categories', CategoryController::class)->except(['create', 'edit']);
    });
});
