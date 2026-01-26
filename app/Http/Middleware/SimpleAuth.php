<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SimpleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek User ID di Session (Prioritas Utama)
        if (Session::has('user_id')) {
            return $next($request);
        }

        // 2. Jika tidak ada di Session, Cek Cookie Remember Me
        $rememberId = \Illuminate\Support\Facades\Cookie::get('remember_user_id');

        if ($rememberId) {
            // Validasi apakah user benar-benar ada
            $user = \App\Models\User::find($rememberId);

            if ($user && $user->status !== 'nonaktif') {
                // Restore session
                Session::put('user_id', $user->id);
                return $next($request);
            }
        }

        // 3. Jika keduanya gagal, redirect ke login
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
}
