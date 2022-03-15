<?php

use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/homepage', [HomeController::class, 'showHomePage']);
Route::get('/search', [HomeController::class, 'showSearchPage']);
Route::get('/category', [HomeController::class, 'showCategory']);
Route::get('/album', [HomeController::class, 'showAlbum']);
Route::get('/author', [HomeController::class, 'showAuthor']);

Auth::routes(['verify' => true]);

Route::prefix('admin')->name('admin.')->middleware(['auth', 'auth.admin', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'showDashdoardScreen'])->name('dashboard');
    Route::resource('authors', AuthorController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('albums', AlbumController::class);
    Route::resource('songs', SongController::class);
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
    });
});

Route::middleware(['auth', 'auth.admin'])->prefix('api')->name('api.')->group(function () {
    Route::get('get-albums-of-authors', [AlbumController::class, 'getAlbumsOfAuthors'])
        ->name('getAlbumsOfAuthors');
});
