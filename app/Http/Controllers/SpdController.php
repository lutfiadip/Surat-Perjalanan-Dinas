<?php

namespace App\Http\Controllers;

use App\Models\PegawaiBkdSpd;
use Illuminate\Http\Request;

class SpdController extends Controller
{
    public function create()
    {
        $pegawais = PegawaiBkdSpd::all();
        return view('spd.form', compact('pegawais'));
    }

    public function print(Request $request)
    {
        // Validate input
        $request->validate([
            'pegawai_ids' => 'required|array',
            'pegawai_ids.*' => 'exists:pegawaibkd_spd,id',
            'nomor_surat' => 'required',
            // Add other validations as needed
        ]);

        // Fetch selected employees
        // We preserve the order of IDs if possible, or just standard find logic
        $selectedPegawais = PegawaiBkdSpd::whereIn('id', $request->pegawai_ids)->get();

        // Sort them to match the order they were selected if needed, 
        // but for now simple collection is fine.
        // However, usually the first one is the "Ketua" or main traveler if not specified.
        // Let's assume the first one selected is the main one for SPD implementation logic.

        // Data input manual
        $data = $request->except('_token', 'pegawai_ids');

        // Format Lama Perjalanan: "1" -> "1 (satu) hari"
        if (isset($data['lama_perjalanan']) && is_numeric($data['lama_perjalanan'])) {
            $num = $data['lama_perjalanan'];
            $text = $this->terbilang($num);
            $data['lama_perjalanan'] = "$num ($text) hari";
        }

        // Hardcoded Signatory (Kepala Badan)
        $signatory = [
            'nama' => 'KURNIADI MAULATO, S.Sos., M.Si',
            'nip' => '19700510 199003 1 006',
            'pangkat' => 'Pembina Utama Muda (IV/c)',
            'jabatan' => 'Kepala Badan Keuangan Daerah',
        ];

        // PPTK / Pejabat Pelaksana Teknis Kegiatan (Usually Kasubbag Umum as per template)
        // For dynamic signature in SPD Part I ("Berangkat dari...")
        $pptk = [
            'nama' => 'NOVAN DEKA SETYA G, S.S.T.P., M.M',
            'nip' => '19901113 201507 1 001',
            'jabatan' => 'Kepala Sub Bagian Umum',
        ];

        return view('spd.print', compact('selectedPegawais', 'data', 'signatory', 'pptk'));
    }

    public function exportWord(Request $request)
    {
        // Re-use logic from print, ideally this should be refactored into a service or private method
        // but for speed, duplicating effectively.

        $request->validate([
            'pegawai_ids' => 'required|array',
            'pegawai_ids.*' => 'exists:pegawaibkd_spd,id',
            'nomor_surat' => 'required',
        ]);

        $selectedPegawais = PegawaiBkdSpd::whereIn('id', $request->pegawai_ids)->get();
        $data = $request->except('_token', 'pegawai_ids');

        if (isset($data['lama_perjalanan']) && is_numeric($data['lama_perjalanan'])) {
            $num = $data['lama_perjalanan'];
            $text = $this->terbilang($num);
            $data['lama_perjalanan'] = "$num ($text) hari";
        }

        $signatory = [
            'nama' => 'KURNIADI MAULATO, S.Sos., M.Si',
            'nip' => '19700510 199003 1 006',
            'pangkat' => 'Pembina Utama Muda (IV/c)',
            'jabatan' => 'Kepala Badan Keuangan Daerah',
        ];

        $pptk = [
            'nama' => 'NOVAN DEKA SETYA G, S.S.T.P., M.M',
            'nip' => '19901113 201507 1 001',
            'jabatan' => 'Kepala Sub Bagian Umum',
        ];

        return response()
            ->view('spd.word', compact('selectedPegawais', 'data', 'signatory', 'pptk'))
            ->header('Content-Type', 'application/vnd.ms-word')
            ->header('Content-Disposition', 'attachment; filename="SPT_SPD.doc"')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    private function terbilang($number)
    {
        $number = abs($number);
        $huruf = [
            "",
            "satu",
            "dua",
            "tiga",
            "empat",
            "lima",
            "enam",
            "tujuh",
            "delapan",
            "sembilan",
            "sepuluh",
            "sebelas"
        ];
        $temp = "";
        if ($number < 12) {
            $temp = " " . $huruf[$number];
        } else if ($number < 20) {
            $temp = $this->terbilang($number - 10) . " belas";
        } else if ($number < 100) {
            $temp = $this->terbilang($number / 10) . " puluh" . $this->terbilang($number % 10);
        } else {
            $temp = " " . $number; // Fallback for > 100 days just in case
        }
        return trim($temp);
    }
}
