<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Closure;

class Pro
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
        if ( !(auth()->user() && auth()->user()->is_pro) ) {
            Session::flash('subscription-required', __('messages.requirePro'));
            return redirect(loc_url(route('plans')));
        }
        return $next($request);
    }
}
