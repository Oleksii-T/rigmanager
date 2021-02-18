<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Closure;

class Standart
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
        if ( !auth()->user()->is_standart ) {
            Session::flash('subscription-required', __('messages.requireStandart'));
            return redirect(loc_url(route('plans')));
        }
        return $next($request);
    }
}
