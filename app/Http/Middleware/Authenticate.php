<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson) {
            return route('login');
        }
    }
}
