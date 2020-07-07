<?php

namespace App\Http\Middleware;

use Closure;

class checkLocale
{
    /**
     * Handle an incoming request, set the language.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( session()->has('locale') ) {
            app()->setLocale(session('locale'));
            app()->setLocale(config('app.locale'));
        } else {
            app()->setLocale('uk');
        }
        return $next($request);
    }
}
