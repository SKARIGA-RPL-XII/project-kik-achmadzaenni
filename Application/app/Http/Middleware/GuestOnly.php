<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GuestOnly
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('userid')) {
            return match (session('roleid')) {
                1 => redirect()->route('admin_dashboard'),
                2 => redirect()->route('penjual_dashboard'),
                default => redirect()->route('user_dashboard'),
            };
        }

        return $next($request);
    }
}
