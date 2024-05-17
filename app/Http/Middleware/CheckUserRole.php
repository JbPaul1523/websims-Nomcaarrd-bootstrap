<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckUserRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $roleCheck = auth()->user()->role;
        // Check if user has any of the required roles
        foreach ($roles as $role) {
            if ($roleCheck >= $role) {
                return $next($request);
            }
        }

        // Redirect if user doesn't have the required role
        return redirect('/403');
    }
}
