<?php

use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\PlaylistController;
use App\Http\Controllers\User\SearchController;
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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/homepage', 'showHomePage');
    Route::get('/category', 'showCategory');
    Route::get('/album', 'showAlbum');
    Route::get('/author', 'showAuthor');
    Route::get('/song', 'showSong');
});

Route::controller(PlaylistController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::resource('playlist', PlaylistController::class)->except(['create', 'edit']);
    Route::post('playlist/add-song/', 'addSongToPlaylist');
    Route::post('playlist/remove-song', 'removeSongFromPlaylist');
    Route::get('/favorite', 'getFavoritePlaylist');
});

Route::get('/search', [SearchController::class, 'showSearchPage']);
Route::get('/comment', [CommentController::class, 'getListComment']);
Route::post('/comment', [CommentController::class, 'storeComment']);

Route::prefix('account')->name('user.account.')->middleware('auth')->group(function () {
    Route::get('/', [AccountController::class, 'show'])->name('show');
    Route::get('/edit', [AccountController::class, 'edit'])->name('edit');
    Route::get('/password', [AccountController::class, 'changePassword'])->name('changePassword');
    Route::match(['PUT', 'PATCH'], '/update', [AccountController::class, 'update'])->name('update');
    Route::match(['PUT', 'PATCH'], '/password/change', [AccountController::class, 'updatePassword'])
        ->name('updatePassword');
});

Auth::routes(['verify' => true]);
Route::get('language/{language}', [LangController::class, 'changeLanguage'])->name('language');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'auth.admin', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'showDashdoardScreen'])->name('dashboard');
    Route::resource('authors', AuthorController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('albums', AlbumController::class);
    Route::resource('songs', SongController::class);
    Route::put('album/add-music', [AlbumController::class, 'addSongToAlbum'])->name('albums.addSong');
    Route::put('album/remove-music', [AlbumController::class, 'removeSongFromAlbum'])->name('albums.removeSong');
    Route::post('category/add-music', [CategoryController::class, 'addSongToCategory'])->name('categories.addSong');
    Route::post('category/remove-music', [CategoryController::class, 'removeFromCategory'])
        ->name('categories.removeSong');
    Route::post('authors/import', [AuthorController::class, 'importExcel'])->name('authors.importExcel');
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::put('/{id}/block', [UserController::class, 'blockUser'])->name('block');
        Route::put('/{id}/unblock', [UserController::class, 'unblockUser'])->name('unblock');
    });

    Route::put('/notify/mark-as-read', [NotificationController::class, 'markAsRead']);
    Route::put('/notify/mark-as-read-all', [NotificationController::class, 'markAsReadAll']);
});

Route::middleware(['auth'])->prefix('api')->name('api.')->group(function () {
    Route::get('get-albums-of-authors', [AlbumController::class, 'getAlbumsOfAuthors'])
        ->name('getAlbumsOfAuthors')
        ->middleware('auth.admin');

    Route::get('search', [SearchController::class, 'search'])->name('user.search');

    Route::get('dashboard/songs/{year}', [DashboardController::class, 'statisticalSongsInYear'])
        ->name('statisticalSongsInYear')
        ->middleware('auth.admin');
});
