<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('userid')) {
            return redirect()->route('loginForm');
        }

        return $next($request);
    }
}
