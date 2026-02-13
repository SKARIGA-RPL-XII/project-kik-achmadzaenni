<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuestOnly
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('userid')) {
            $redirect = match (session('roleid')) {
                1 => redirect()->route('admin_dashboard'),
                2 => redirect()->route('penjual_dashboard'),
                default => redirect()->route('user_dashboard'),
            };
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
