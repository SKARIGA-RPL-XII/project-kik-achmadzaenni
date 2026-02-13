<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('userid')) {
            $redirect = redirect()->route('loginForm');
            $redirect->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
            $redirect->headers->set('Pragma', 'no-cache');
            $redirect->headers->set('Expires', '0');
            return $redirect;
        }

        $response = $next($request);
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');
        return $response;
    }
}
