<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpdController;

use App\Http\Controllers\LoginController;

Route::get('/', function () {
    $user = null;
    if (Illuminate\Support\Facades\Session::has('user_id')) {
        $user = App\Models\User::find(Illuminate\Support\Facades\Session::get('user_id'));
    }
    return view('landing', compact('user'));
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['simple.auth'])->group(function () {
    Route::get('/spd', [SpdController::class, 'create'])->name('spd.form');
    Route::post('/spd/print', [SpdController::class, 'print'])->name('spd.print');
    Route::post('/spd/export-word', [SpdController::class, 'exportWord'])->name('spd.export_word');
});
