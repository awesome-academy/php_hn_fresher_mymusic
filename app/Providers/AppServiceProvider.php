<?php

namespace App\Providers;

use App\Repositories\Admin\Author\AuthorRepoInterface;
use App\Repositories\Admin\Author\AuthorRepository;
use App\Repositories\Admin\Category\CategoryRepository;
use App\Repositories\Admin\Category\CategoryRepositoryInterface;
use App\Repositories\Admin\Album\AlbumRepository;
use App\Repositories\Admin\Album\AlbumRepoInterface;
use App\Repositories\Admin\Song\SongRepository;
use App\Repositories\Admin\Song\SongRepositoryInterface;
use App\Repositories\Admin\Playlist\PlaylistRepository;
use App\Repositories\Admin\Playlist\PlaylistRepoInterface;
use App\Repositories\User\UserRepoInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\CommentRepository;
use App\Repositories\User\CommentRepoInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            AuthorRepoInterface::class,
            AuthorRepository::class
        );

        $this->app->singleton(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->singleton(
            AlbumRepoInterface::class,
            AlbumRepository::class
        );

        $this->app->singleton(
            SongRepositoryInterface::class,
            SongRepository::class
        );

        $this->app->singleton(
            PlaylistRepoInterface::class,
            PlaylistRepository::class
        );

        $this->app->singleton(
            UserRepoInterface::class,
            UserRepository::class
        );

        $this->app->singleton(
            CommentRepoInterface::class,
            CommentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Carbon::setLocale(config('app.locale'));
    }
}
