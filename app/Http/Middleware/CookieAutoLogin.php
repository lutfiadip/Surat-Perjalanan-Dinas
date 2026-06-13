<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class CookieAutoLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika session tidak ada user_id, coba restore dari cookie remember me
        if (!Session::has('user_id')) {
            $rememberId = Cookie::get('remember_user_id');

            if ($rememberId) {
                $user = User::find($rememberId);

                if ($user && $user->status !== 'nonaktif') {
                    Session::put('user_id', $user->id);
                    Session::put('role', $user->role);
                    Session::put('name', $user->name);
                }
            }
        }

        return $next($request);
    }
}
