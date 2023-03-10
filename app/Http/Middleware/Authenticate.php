<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Auth;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request, $guard = null)
    {
        if ($guard == 'web')
        {
            if (!Auth::check())
            {
                 return redirect()->route('user.login');
            }
        }
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
