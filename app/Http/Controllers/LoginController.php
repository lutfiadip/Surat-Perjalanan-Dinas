<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        // Jika sudah login, redirect ke halaman utama/SPD
        if (Session::has('user_id')) {
            return redirect()->route('spd.form');
        }
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        // Cek user, password hash, dan status
        if ($user && Hash::check($request->password, $user->password)) {

            if ($user->status === 'nonaktif') {
                return back()->with('error', 'Akun Anda dinonaktifkan.');
            }

            // Simpan user_id ke session
            Session::put('user_id', $user->id);

            // Fitur Remember Me (Manual Cookie)
            if ($request->has('remember')) {
                // Simpan ID user di cookie selama 30 hari (minutes)
                // Cookie Laravel otomatis terenkripsi
                \Illuminate\Support\Facades\Cookie::queue('remember_user_id', $user->id, 60 * 24 * 30);
            }

            return redirect()->route('spd.draft');
        }

        return back()->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        Session::forget('user_id');
        Session::flush(); // Opsional: bersihkan semua data session

        // Hapus cookie remember me
        \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::forget('remember_user_id'));

        return redirect('/');
    }
}
