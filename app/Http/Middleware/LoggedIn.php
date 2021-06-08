<?php

namespace App\Http\Middleware;

use Closure, View, Route;
use Illuminate\Support\Facades\Auth;

class LoggedIn
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()) {
            return redirect()->route('welcome', app()->getLocale());
        } else {
            return $next($request);
        }
    }
}
