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
})->name('landing');

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
    Route::post('/spd/print-bulk', [SpdController::class, 'bulkPrint'])->name('spd.bulk_print');

});

// Admin Routes
Route::middleware(['simple.auth', \App\Http\Middleware\RoleMiddleware::class . ':admin'])->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');

    // Pegawai
    Route::get('/pegawai', [App\Http\Controllers\AdminPegawaiController::class, 'index'])->name('admin.pegawai.index');
    Route::get('/pegawai/create', [App\Http\Controllers\AdminPegawaiController::class, 'create'])->name('admin.pegawai.create');
    Route::post('/pegawai', [App\Http\Controllers\AdminPegawaiController::class, 'store'])->name('admin.pegawai.store');
    Route::get('/pegawai/{id}/edit', [App\Http\Controllers\AdminPegawaiController::class, 'edit'])->name('admin.pegawai.edit');
    Route::put('/pegawai/{id}', [App\Http\Controllers\AdminPegawaiController::class, 'update'])->name('admin.pegawai.update');
    Route::patch('/pegawai/{id}/toggle-status', [App\Http\Controllers\AdminPegawaiController::class, 'toggleStatus'])->name('admin.pegawai.toggle_status');
    Route::delete('/pegawai/{id}', [App\Http\Controllers\AdminPegawaiController::class, 'destroy'])->name('admin.pegawai.destroy');
    Route::post('/pegawai/delete-batch', [App\Http\Controllers\AdminPegawaiController::class, 'bulkDestroy'])->name('admin.pegawai.bulk_destroy');

    // Penandatangan
    Route::get('/penandatangan', [App\Http\Controllers\AdminPenandatanganController::class, 'index'])->name('admin.penandatangan.index');
    Route::get('/penandatangan/create', [App\Http\Controllers\AdminPenandatanganController::class, 'create'])->name('admin.penandatangan.create');
    Route::post('/penandatangan', [App\Http\Controllers\AdminPenandatanganController::class, 'store'])->name('admin.penandatangan.store');
    Route::get('/penandatangan/{id}/edit', [App\Http\Controllers\AdminPenandatanganController::class, 'edit'])->name('admin.penandatangan.edit');
    Route::put('/penandatangan/{id}', [App\Http\Controllers\AdminPenandatanganController::class, 'update'])->name('admin.penandatangan.update');
    Route::patch('/penandatangan/{id}/toggle-status', [App\Http\Controllers\AdminPenandatanganController::class, 'toggleStatus'])->name('admin.penandatangan.toggle_status');
    Route::delete('/penandatangan/{id}', [App\Http\Controllers\AdminPenandatanganController::class, 'destroy'])->name('admin.penandatangan.destroy');
    Route::post('/penandatangan/delete-batch', [App\Http\Controllers\AdminPenandatanganController::class, 'bulkDestroy'])->name('admin.penandatangan.bulk_destroy');

    // Users
    Route::get('/users', [App\Http\Controllers\AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [App\Http\Controllers\AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [App\Http\Controllers\AdminUserController::class, 'store'])->name('admin.users.store');
    Route::patch('/users/{id}/toggle-status', [App\Http\Controllers\AdminUserController::class, 'toggleStatus'])->name('admin.users.toggle_status');
    // Note: No edit for users requested/implied beyond status, but maybe simple edit for role/name? 
    // Requirement says Aksi (Aktifkan / Nonaktifkan). Button "+ Tambah User".
    // I won't add Edit User route unless necessary, or maybe just simple edit.
    // Let's add Edit just in case for correcting name/role.
    Route::get('/users/{id}/edit', [App\Http\Controllers\AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [App\Http\Controllers\AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [App\Http\Controllers\AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('/users/delete-batch', [App\Http\Controllers\AdminUserController::class, 'bulkDestroy'])->name('admin.users.bulk_destroy');
});
