<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
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
//        $user = Auth::user();
//
//        dd($user);
//
//        if ($user) {
//            app()->setLocale($user->language);
//        }
//
//        app()->setLocale('');
//        Carbon::setLocale('');
//
        return $next($request);
    }
}