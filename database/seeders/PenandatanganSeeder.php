<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penandatangan;

class PenandatanganSeeder extends Seeder
{
    public function run()
    {
        // Clear existing to avoid duplicates during dev seeding
        // Penandatangan::truncate(); // Careful with truncate if user has other data, but for now this is safe as table is new/dev.
        // Actually, let's use Create or Update logic to be safe.

        // Data Kepala
        Penandatangan::updateOrCreate(
            ['nip' => '19700510 199003 1 006'], // Check by NIP
            [
                'nama' => 'KURNIADI MAULATO, S.Sos., M.Si',
                'pangkat' => 'Pembina Utama Muda (IV/c)',
                'jabatan' => 'Kepala Badan Keuangan Daerah',
                'jenis' => 'kepala',
                'status_aktif' => 1,
            ]
        );

        // Data Sekretaris
        Penandatangan::updateOrCreate(
            ['nip' => '19710515 199003 1 002'],
            [
                'nama' => 'PUJIYANTO, S.Sos, M.Si.',
                'pangkat' => 'Pembina Tk.I (IV/b)',
                'jabatan' => 'Sekretaris',
                'jenis' => 'kepala',
                'status_aktif' => 1,
            ]
        );

        // Data PPTK
        Penandatangan::updateOrCreate(
            ['nip' => '19901113 201507 1 001'],
            [
                'nama' => 'NOVAN DEKA SETYA G, S.S.T.P., M.M',
                'pangkat' => '', // PPTK might not need pangkat shown in the same way, or it's not in the previous array. Let's check controller.
                // Checking controller... PPTK array had: nama, nip, jabatan. No pangkat.
                // But let's leave valid empty string or null.
                'jabatan' => 'Kepala Sub Bagian Umum',
                'jenis' => 'pptk',
                'status_aktif' => 1,
            ]
        );
    }
}
