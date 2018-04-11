<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LocaleMiddleware
{
    protected $languages = ['en', 'nl'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $lang = Auth::user()->preferences['language'];

            app()->setLocale($lang);
        }

        else {
            app()->setLocale(env('APP_LOCALE'));
        }

        return $next($request);
    }
}
