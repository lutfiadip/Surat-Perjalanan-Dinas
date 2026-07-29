<?php

namespace App\Providers;

use Native\Laravel\Facades\Window;
use Native\Laravel\Contracts\ProvidesPhpIni;

class NativeAppServiceProvider implements ProvidesPhpIni
{
    /**
     * Executed once the native application has been booted.
     * Use this method to open windows, register global shortcuts, etc.
     */
    public function boot(): void
    {
        try {
            $firstPegawai = \App\Models\PegawaiBkdSpd::first();
            if (\App\Models\User::count() === 0 || !$firstPegawai || empty($firstPegawai->pangkat_gol)) {
                \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
            }
        } catch (\Exception $e) {
            // Abaikan jika tabel belum ada (saat proses migrasi awal oleh NativePHP belum selesai)
        }

        Window::open()
            ->title('Surat Perjalanan Dinas - BKD')
            ->width(1200)
            ->height(800);
    }

    /**
     * Return an array of php.ini directives to be set.
     */
    public function phpIni(): array
    {
        return [
        ];
    }
}
