<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleCheck
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (session('roleid') != $role) {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}
