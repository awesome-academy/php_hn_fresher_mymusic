<?php

namespace App\Providers;

use App\Repositories\Admin\Author\AuthorRepoInterface;
use App\Repositories\Admin\Author\AuthorRepository;
use App\Repositories\Admin\Category\CategoryRepository;
use App\Repositories\Admin\Category\CategoryRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
