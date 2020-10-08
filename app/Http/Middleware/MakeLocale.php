<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;

class MakeLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd($request);
        if (session()->has('locale')) {
            //var_dump('MakeLocale. the is locale in sesion ' . session('locale'));
        } else {
            //var_dump('MakeLocale. no locale in sesion');
        }
        $locale = 'uk';
        if ($request->method() === 'GET') {
            //var_dump('  MakeLocale. GET');
            $segment = $request->segment(1);
            
            if (in_array($segment, config('app.locales'))) {
                $locale = $segment;
                //var_dump('  MakeLocale. ocale is in url');
            }
        } else {
            //var_dump('  MakeLocale. POST');
            if ( session()->has('locale') ) {
                $locale = session('locale');
            }
        }
        //var_dump('  MakeLocale. New locale = ['.$locale.']');
        session(['locale' => $locale]);
        app()->setLocale($locale);
        return $next($request);
    }
}
