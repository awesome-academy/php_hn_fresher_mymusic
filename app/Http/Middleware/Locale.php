<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $lang = Session::get(
            'website_language',
            Config::get('app.locale')
        );

        App::setLocale($lang);

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

        return $next($request);
    }
}
