<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if ( $request->expectsJson()) {
            return route('login');
        }
        if ( $request->is('admin') || $request->is('admin/*')) {
            return '/login/admin';
        }
        if ( $request->is('medshop') || $request->is('medshop/*')) {
            return '/login/medshop';
        }
        return route('login');
    }
}
