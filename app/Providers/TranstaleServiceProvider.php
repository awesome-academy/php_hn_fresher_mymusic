<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class TranstaleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::share(
            'translation',
            collect(File::allFiles(resource_path('lang/' . App::getLocale())))
                ->flatMap(
                    function ($file) {
                        return [
                            ($translation = $file->getBasename('.php')) => trans($translation),
                        ];
                    }
                )->toJson()
        );
        View::share(
            'translationJson',
            File::get(resource_path('lang/' . App::getLocale() . '.json'))
        );
    }
}
