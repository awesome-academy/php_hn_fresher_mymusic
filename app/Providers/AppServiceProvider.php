<?php

namespace App\Providers;

use App\Repositories\Admin\Author\AuthorRepoInterface;
use App\Repositories\Admin\Author\AuthorRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
