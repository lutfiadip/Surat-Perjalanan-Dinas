<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Check if user is logged in
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Get current user's role from session
        $userRole = Session::get('role', 'user'); // Default to 'user' if not set

        // 3. Admin has access to everything for now (super user concept), 
        //    UNLESS we strictly want to separate concerns.
        //    But requirement says: "ADMIN IS ALLOWED TO: All permissions of USER".
        //    So if route requires 'user', admin is also allowed.
        if ($userRole === 'admin') {
            return $next($request);
        }

        // 4. If current role matches the required role
        if ($userRole === $role) {
            return $next($request);
        }

        // 5. If role mismatch (e.g. User trying to access Admin route)
        abort(403, 'Unauthorized action.');
    }
}
