<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Http\Request;

//class Authenticate extends Middleware
//{ 
    class AdminMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    protected function redirectTo(Request $request, Closure $next)
    {
        if (!auth()->guard('user')->check()) {
            return redirect()->route('user.login');
        }
        return $next($request);
    }
}
