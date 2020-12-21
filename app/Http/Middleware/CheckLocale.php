<?php

namespace App\Http\Middleware;

use Closure;

class CheckLocale
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
        if ($request->method() === 'GET') {
            $locale = $request->segment(1);
            if (!in_array($locale, config('app.locales'))) {
                abort(404);
            }
        }
        return $next($request);
    }
}
