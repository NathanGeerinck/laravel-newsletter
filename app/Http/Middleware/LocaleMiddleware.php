<?php

namespace App\Http\Middleware;

use Closure;

class LocaleMiddleware
{
    protected $languages = ['en','nl'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        app()->setLocale(env('APP_LOCALE'));

        return $next($request);
    }
}
