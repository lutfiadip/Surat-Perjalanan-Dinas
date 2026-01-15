<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpdController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/spd', [SpdController::class, 'create'])->name('spd.form');
Route::post('/spd/print', [SpdController::class, 'print'])->name('spd.print');
Route::post('/spd/export-word', [SpdController::class, 'exportWord'])->name('spd.export_word');
