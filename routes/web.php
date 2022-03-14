<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SongController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);

Route::prefix('admin')->name('admin.')->middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'showDashdoardScreen'])->name('dashboard');
    Route::resource('authors', AuthorController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('albums', AlbumController::class);
    Route::resource('songs', SongController::class);
});
