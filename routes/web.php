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
    Route::get('/spd', [SpdController::class, 'draft'])->name('spd.index'); // Changed default to draft
    Route::get('/spd/create', [SpdController::class, 'create'])->name('spd.create'); // Alias
    Route::post('/spd/store', [SpdController::class, 'store'])->name('spd.store');
    Route::get('/spd/draft', [SpdController::class, 'draft'])->name('spd.draft');
    Route::get('/spd/edit/{id}', [SpdController::class, 'edit'])->name('spd.edit');
    Route::get('/spd/print/{id}', [SpdController::class, 'printFinal'])->name('spd.print.final');
    Route::get('/spd/export-word/{id}', [SpdController::class, 'exportWordFinal'])->name('spd.export_word.final');
    Route::delete('/spd/delete/{id}', [SpdController::class, 'destroy'])->name('spd.destroy');
    Route::post('/spd/delete-batch', [SpdController::class, 'bulkDestroy'])->name('spd.bulk_destroy');
    Route::post('/spd/print', [SpdController::class, 'print'])->name('spd.print');
    Route::post('/spd/export-word', [SpdController::class, 'exportWord'])->name('spd.export_word');
});
