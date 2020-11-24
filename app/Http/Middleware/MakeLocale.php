<?php

namespace App\Http\Middleware;

use Closure;

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
        $locale = 'uk';
        if ($request->method() === 'GET') {
            $segment = $request->segment(1);

            if (in_array($segment, config('app.locales'))) {
                $locale = $segment;
            }
        } else {
            if ( session()->has('locale') ) {
                $locale = session('locale');
            }
        }
        session(['locale' => $locale]);
        app()->setLocale($locale);
        return $next($request);
    }
}
