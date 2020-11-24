<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Traits\Subscription;
use Illuminate\Support\Facades\Session;
use Closure;

class Premium
{
    use Subscription;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->isPremium()) {
            Session::flash('subscription-required', __('messages.requirePremium'));
            return redirect(loc_url(route('plans')));
        }
        return $next($request);
    }
}
