<?php

namespace App\Http\Controllers;

use App\Models\PegawaiBkdSpd;
use App\Models\Spd;
use Illuminate\Http\Request;

class SpdController extends Controller
{
    public function create(Request $request)
    {
        $pegawais = PegawaiBkdSpd::all();
        $signatories = [
            'kepala' => [
                'nama' => 'KURNIADI MAULATO, S.Sos., M.Si',
                'nama_title' => 'Kurniadi Maulato, S.Sos., M.Si',
                'nip' => '19700510 199003 1 006',
                'pangkat' => 'Pembina Utama Muda (IV/c)',
                'jabatan' => 'Kepala Badan Keuangan Daerah',
            ],
            'sekretaris' => [
                'nama' => 'PUJIYANTO, S.Sos, M.Si.',
                'nama_title' => 'Pujiyanto, S.Sos, M.Si.',
                'nip' => '19710515 199003 1 002',
                'pangkat' => 'Pembina Tk.I (IV/b)',
                'jabatan' => 'Sekretaris',
            ]
        ];

        $draft = null;
        $pegawaiUtama = null;
        $pengikuts = [];

        if ($request->has('id')) {
            $draft = Spd::where('id', $request->id)
                ->where('created_by', session('user_id'))
                ->with('pegawais')
                ->first();

            if ($draft) {
                // Separate Roles
                $pegawaiUtama = $draft->pegawais->where('pivot.peran', 'utama')->first();
                // Pengikuts as array of objects for easier JS handling or collection
                $pengikuts = $draft->pegawais->where('pivot.peran', 'pengikut')->values();
            }
        }

        return view('spd.form', compact('pegawais', 'signatories', 'draft', 'pegawaiUtama', 'pengikuts'));
    }

    public function edit($id)
    {
        // 1. Ambil data pegawais untuk dropdown (sama seperti create)
        $pegawais = PegawaiBkdSpd::all();

        // 2. Definisi signatories (sama seperti create)
        $signatories = [
            'kepala' => [
                'nama' => 'KURNIADI MAULATO, S.Sos., M.Si',
                'nama_title' => 'Kurniadi Maulato, S.Sos., M.Si',
                'nip' => '19700510 199003 1 006',
                'pangkat' => 'Pembina Utama Muda (IV/c)',
                'jabatan' => 'Kepala Badan Keuangan Daerah',
            ],
            'sekretaris' => [
                'nama' => 'PUJIYANTO, S.Sos, M.Si.',
                'nama_title' => 'Pujiyanto, S.Sos, M.Si.',
                'nip' => '19710515 199003 1 002',
                'pangkat' => 'Pembina Tk.I (IV/b)',
                'jabatan' => 'Sekretaris',
            ]
        ];

        // 3. Ambil Draft SPD berdasarkan ID & Session User
        // STRICT: Hanya boleh edit punya sendiri
        $draft = Spd::where('id', $id)
            ->where('created_by', session('user_id'))
            ->with('pegawais')
            ->firstOrFail();

        // 4. Pisahkan Pegawai Utama & Pengikut
        $pegawaiUtama = $draft->pegawais->where('pivot.peran', 'utama')->first();
        $pengikuts = $draft->pegawais->where('pivot.peran', 'pengikut')->values();

        // 5. Return view yang sama (form.blade.php sudah support edit mode)
        return view('spd.form', compact('pegawais', 'signatories', 'draft', 'pegawaiUtama', 'pengikuts'));
    }

    public function store(Request $request)
    {
        $action = $request->input('action', 'draft');
        $userId = session('user_id');

        // Common Data
        $data = $request->except('_token', 'pegawai_ids', 'pegawai_utama', 'pengikut', 'action');
        $data['created_by'] = $userId;

        // Validation Rules
        if ($action === 'final') {
            $request->validate([
                'pegawai_utama' => 'required|exists:pegawaibkd_spd,id',
                'maksud' => 'required',
                'tanggal_surat' => 'required|date',
                'tgl_berangkat' => 'required|date',
                'tgl_kembali' => 'required|date',
                'tempat_berangkat' => 'required',
                'tempat' => 'required', // Tempat Tujuan
                'anggaran_skpd' => 'required',
            ]);
            $data['status'] = 'final';

            // Generate Internal Number if not exists
            // Format: SPD/YYYY/MM/RANDOM (simple unique fallback)
            // Ideally should be sequential but user asked for simple
            $data['nomor_surat_tugas'] = 'SPD/' . date('Y') . '/' . date('m') . '/' . mt_rand(1000, 9999);

        } else {
            // Draft: Minimal validation or nullable allowed
            $data['status'] = 'draft';
        }

        // Check if updating
        $spd = null;
        if ($request->has('id') && $request->id) {
            // STRICT UPDATE: Must verify ownership
            $spd = Spd::where('id', $request->id)
                ->where('created_by', $userId)
                ->first();

            if (!$spd) {
                abort(404, 'Draft not found or unauthorized.');
            }

            // If already final, prevent changes (Security check)
            if ($spd->status === 'final') {
                // Or redirect with error
                return redirect()->route('spd.draft')->with('error', 'Dokumen sudah final dan tidak dapat diedit.');
            }

            // Perform Update
            $spd->update($data);

            // Wipe existing relations to avoid duplicates
            $spd->pegawais()->detach();
        } else {
            // STRICT CREATE: Only if no ID
            // NOTE: If action is 'final' on a new create (unlikely flow but possible if button mashed), we allow it.
            $spd = Spd::create($data);
        }

        // 1. Pegawai Utama
        if ($request->filled('pegawai_utama')) {
            $spd->pegawais()->attach($request->pegawai_utama, ['peran' => 'utama']);
        }

        // 2. Pengikut
        if ($request->has('pengikut') && is_array($request->pengikut)) {
            $pengikutIds = array_unique($request->pengikut);
            foreach ($pengikutIds as $id) {
                if ($id != $request->pegawai_utama) {
                    $spd->pegawais()->attach($id, ['peran' => 'pengikut']);
                }
            }
        }

        $message = ($action === 'final') ? 'Dokumen berhasil difinalisasi.' : 'Draft berhasil disimpan.';
        return redirect()->route('spd.draft')->with('success', $message);
    }

    public function draft()
    {
        $userId = session('user_id');

        // DRAFTS
        $drafts = Spd::where('created_by', $userId)
            ->where('status', 'draft')
            ->orderBy('id', 'desc')
            ->get();

        // FINALS (Arsip)
        $finals = Spd::where('created_by', $userId)
            ->where('status', 'final')
            ->orderBy('id', 'desc')
            ->get();

        return view('spd.draft', compact('drafts', 'finals'));
    }

    public function print(Request $request)
    {
        // Validate input
        $request->validate([
            'pegawai_utama' => 'required|exists:pegawaibkd_spd,id',
            'pengikut' => 'nullable|array',
            'pengikut.*' => 'exists:pegawaibkd_spd,id',
            'nomor_surat' => 'nullable',
            // Add other validations as needed
        ]);

        // Fetch selected employees
        // We preserve the order of IDs if possible, or just standard find logic
        // Fetch selected employees and Sort by selection order
        $ids = array_merge([$request->pegawai_utama], $request->input('pengikut', []));
        $ids = array_unique($ids); // Remove duplicates if any
        $pegawais = PegawaiBkdSpd::whereIn('id', $ids)->get();

        $selectedPegawais = collect($ids)->map(function ($id) use ($pegawais) {
            return $pegawais->firstWhere('id', $id);
        })->filter(); // Remove nulls if any ID not found

        // Sort them to match the order they were selected if needed, 
        // but for now simple collection is fine.
        // However, usually the first one is the "Ketua" or main traveler if not specified.
        // Let's assume the first one selected is the main one for SPD implementation logic.

        // Data input manual
        $data = $request->except('_token', 'pegawai_ids');

        if (isset($data['lama_perjalanan']) && is_numeric($data['lama_perjalanan'])) {
            $num = $data['lama_perjalanan'];
            $text = $this->terbilang($num);
            $data['lama_perjalanan'] = "$num ($text) hari";
        }

        // Format Dates: Y-m-d -> 8 Januari 2026
        $dateFields = ['tanggal_surat', 'tanggal_kegiatan', 'tgl_berangkat', 'tgl_kembali'];
        foreach ($dateFields as $field) {
            if (isset($data[$field])) {
                try {
                    $data[$field] = \Carbon\Carbon::parse($data[$field])->locale('id')->isoFormat('D MMMM Y');
                } catch (\Exception $e) {
                    // keep original if parse fails
                }
            }
        }

        // Signatory Selection
        $signerType = $request->input('penandatangan', 'kepala');

        if ($signerType == 'sekretaris') {
            $signatory = [
                'nama' => 'PUJIYANTO, S.Sos, M.Si.',
                'nama_title' => 'Pujiyanto, S.Sos, M.Si.',
                'nip' => '19710515 199003 1 002',
                'pangkat' => 'Pembina Tk.I (IV/b)',
                'jabatan' => 'Sekretaris',
                'jabatan_head_page3' => 'Kepala Badan Keuangan Daerah',
            ];
            $tgl = $data['tanggal_surat'] ?? now()->locale('id')->isoFormat('D MMMM Y');
            $signatory['full_signature_page1'] = '<table style="width: 100%; border: none; border-collapse: collapse;">
                <tr><td colspan="2" style="height: 20px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="border: none; padding: 0;">' . $tgl . '</td></tr>
                <tr><td style="vertical-align: top; border: none; padding: 0;">a.n.</td><td style="vertical-align: top; border: none; padding: 0;">Kepala Badan Keuangan Daerah<br>Sekretaris</td></tr>
                <tr><td colspan="2" style="height: 70px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="vertical-align: top; border: none; padding: 0;">' . $signatory['nama_title'] . '<br>' . $signatory['pangkat'] . '<br>NIP. ' . $signatory['nip'] . '</td></tr>
            </table>';
        } else {
            $signatory = [
                'nama' => 'KURNIADI MAULATO, S.Sos., M.Si',
                'nama_title' => 'Kurniadi Maulato, S.Sos., M.Si',
                'nip' => '19700510 199003 1 006',
                'pangkat' => 'Pembina Utama Muda (IV/c)',
                'jabatan' => 'Kepala Badan Keuangan Daerah',
                'jabatan_head_page3' => 'Kepala Badan Keuangan Daerah',
            ];
            $tgl = $data['tanggal_surat'] ?? now()->locale('id')->isoFormat('D MMMM Y');
            $signatory['full_signature_page1'] = '<br>' . $tgl . '<br>Kepala Badan Keuangan Daerah<br><br><br><br><br>' . $signatory['nama_title'] . '<br>' . $signatory['pangkat'] . '<br>NIP. ' . $signatory['nip'];
        }

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
            'pegawai_utama' => 'required|exists:pegawaibkd_spd,id',
            'pengikut' => 'nullable|array',
            'pengikut.*' => 'exists:pegawaibkd_spd,id',
            'nomor_surat' => 'nullable',
        ]);

        // Fetch selected employees and Sort by selection order
        $ids = array_merge([$request->pegawai_utama], $request->input('pengikut', []));
        $ids = array_unique($ids); // Remove duplicates if any
        $pegawais = PegawaiBkdSpd::whereIn('id', $ids)->get();

        $selectedPegawais = collect($ids)->map(function ($id) use ($pegawais) {
            return $pegawais->firstWhere('id', $id);
        })->filter();
        $data = $request->except('_token', 'pegawai_ids');

        if (isset($data['lama_perjalanan']) && is_numeric($data['lama_perjalanan'])) {
            $num = $data['lama_perjalanan'];
            $text = $this->terbilang($num);
            $data['lama_perjalanan'] = "$num ($text) hari";
        }

        // Format Dates: Y-m-d -> 8 Januari 2026
        $dateFields = ['tanggal_surat', 'tanggal_kegiatan', 'tgl_berangkat', 'tgl_kembali'];
        foreach ($dateFields as $field) {
            if (isset($data[$field])) {
                try {
                    $data[$field] = \Carbon\Carbon::parse($data[$field])->locale('id')->isoFormat('D MMMM Y');
                } catch (\Exception $e) {
                    // keep original if parse fails
                }
            }
        }

        // Signatory Selection
        $signerType = $request->input('penandatangan', 'kepala');

        if ($signerType == 'sekretaris') {
            $signatory = [
                'nama' => 'PUJIYANTO, S.Sos, M.Si.',
                'nama_title' => 'Pujiyanto, S.Sos, M.Si.',
                'nip' => '19710515 199003 1 002',
                'pangkat' => 'Pembina Tk.I (IV/b)',
                'jabatan' => 'Sekretaris',
                'jabatan_head_page3' => 'Kepala Badan Keuangan Daerah',
            ];
            $tgl = $data['tanggal_surat'] ?? now()->locale('id')->isoFormat('D MMMM Y');
            $signatory['full_signature_page1'] = '<table style="width: 100%; border: none; border-collapse: collapse;">
                <tr><td colspan="2" style="height: 20px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="border: none; padding: 0;">' . $tgl . '</td></tr>
                <tr><td style="vertical-align: top; border: none; padding: 0;">a.n.</td><td style="vertical-align: top; border: none; padding: 0;">Kepala Badan Keuangan Daerah<br>Sekretaris</td></tr>
                <tr><td colspan="2" style="height: 70px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="vertical-align: top; border: none; padding: 0;">' . $signatory['nama_title'] . '<br>' . $signatory['pangkat'] . '<br>NIP. ' . $signatory['nip'] . '</td></tr>
            </table>';
        } else {
            $signatory = [
                'nama' => 'KURNIADI MAULATO, S.Sos., M.Si',
                'nama_title' => 'Kurniadi Maulato, S.Sos., M.Si',
                'nip' => '19700510 199003 1 006',
                'pangkat' => 'Pembina Utama Muda (IV/c)',
                'jabatan' => 'Kepala Badan Keuangan Daerah',
                'jabatan_head_page3' => 'Kepala Badan Keuangan Daerah',
            ];
            $tgl = $data['tanggal_surat'] ?? now()->locale('id')->isoFormat('D MMMM Y');
            $signatory['full_signature_page1'] = '<br>' . $tgl . '<br>Kepala Badan Keuangan Daerah<br><br><br><br><br>' . $signatory['nama_title'] . '<br>' . $signatory['pangkat'] . '<br>NIP. ' . $signatory['nip'];
        }

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

    public function printFinal($id)
    {
        $data = $this->prepareDataFromModel($id);
        return view('spd.print', $data);
    }

    public function exportWordFinal($id)
    {
        $data = $this->prepareDataFromModel($id);

        return response()
            ->view('spd.word', $data)
            ->header('Content-Type', 'application/vnd.ms-word')
            ->header('Content-Disposition', 'attachment; filename="SPT_SPD_FINAL.doc"')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    private function prepareDataFromModel($id)
    {
        // 1. Fetch SPD
        $spd = Spd::where('id', $id)
            ->where('created_by', session('user_id'))
            ->where('status', 'final')
            ->with('pegawais')
            ->firstOrFail();

        // 2. Prepare Pegawais
        // Sort: Utama first, then Pengikut order (if pivot has info, otherwise generic)
        // We can use pivot 'peran' to sort. 'utama' < 'pengikut'.
        $sortedPegawais = $spd->pegawais->sortBy(function ($pegawai) {
            return $pegawai->pivot->peran === 'utama' ? 0 : 1;
        });

        $selectedPegawais = $sortedPegawais;

        // 3. Prepare Data Array
        $data = $spd->toArray();

        // 4. Processing logic (duplicated from print)
        if (isset($data['lama_perjalanan']) && is_numeric($data['lama_perjalanan'])) {
            $num = $data['lama_perjalanan'];
            $text = $this->terbilang($num);
            $data['lama_perjalanan'] = "$num ($text) hari";
        }

        // Format Dates
        $dateFields = ['tanggal_surat', 'tanggal_kegiatan', 'tgl_berangkat', 'tgl_kembali'];
        foreach ($dateFields as $field) {
            if (isset($data[$field])) {
                try {
                    $data[$field] = \Carbon\Carbon::parse($data[$field])->locale('id')->isoFormat('D MMMM Y');
                } catch (\Exception $e) {
                }
            }
        }

        // 5. Signatory
        $signerType = $data['penandatangan'] ?? 'kepala';

        if ($signerType == 'sekretaris') {
            $signatory = [
                'nama' => 'PUJIYANTO, S.Sos, M.Si.',
                'nama_title' => 'Pujiyanto, S.Sos, M.Si.',
                'nip' => '19710515 199003 1 002',
                'pangkat' => 'Pembina Tk.I (IV/b)',
                'jabatan' => 'Sekretaris',
                'jabatan_head_page3' => 'Kepala Badan Keuangan Daerah',
            ];
            $tgl = $data['tanggal_surat'] ?? now()->locale('id')->isoFormat('D MMMM Y');
            $signatory['full_signature_page1'] = '<table style="width: 100%; border: none; border-collapse: collapse;">
                <tr><td colspan="2" style="height: 20px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="border: none; padding: 0;">' . $tgl . '</td></tr>
                <tr><td style="vertical-align: top; border: none; padding: 0;">a.n.</td><td style="vertical-align: top; border: none; padding: 0;">Kepala Badan Keuangan Daerah<br>Sekretaris</td></tr>
                <tr><td colspan="2" style="height: 70px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="vertical-align: top; border: none; padding: 0;">' . $signatory['nama_title'] . '<br>' . $signatory['pangkat'] . '<br>NIP. ' . $signatory['nip'] . '</td></tr>
            </table>';
        } else {
            $signatory = [
                'nama' => 'KURNIADI MAULATO, S.Sos., M.Si',
                'nama_title' => 'Kurniadi Maulato, S.Sos., M.Si',
                'nip' => '19700510 199003 1 006',
                'pangkat' => 'Pembina Utama Muda (IV/c)',
                'jabatan' => 'Kepala Badan Keuangan Daerah',
                'jabatan_head_page3' => 'Kepala Badan Keuangan Daerah',
            ];
            $tgl = $data['tanggal_surat'] ?? now()->locale('id')->isoFormat('D MMMM Y');
            $signatory['full_signature_page1'] = '<br>' . $tgl . '<br>Kepala Badan Keuangan Daerah<br><br><br><br><br>' . $signatory['nama_title'] . '<br>' . $signatory['pangkat'] . '<br>NIP. ' . $signatory['nip'];
        }

        // 6. PPTK
        $pptk = [
            'nama' => 'NOVAN DEKA SETYA G, S.S.T.P., M.M',
            'nip' => '19901113 201507 1 001',
            'jabatan' => 'Kepala Sub Bagian Umum',
        ];

        return compact('selectedPegawais', 'data', 'signatory', 'pptk');
    }

    public function destroy($id)
    {
        $userId = session('user_id');

        // STRICT: Only delete own records
        $spd = Spd::where('id', $id)
            ->where('created_by', $userId)
            ->firstOrFail();

        // 1. Detach Pegawai relations (Cleanup pivot)
        $spd->pegawais()->detach();

        // 2. Hard Delete
        $spd->delete();

        return redirect()->route('spd.draft')->with('success', 'Dokumen SPD berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $userId = session('user_id');
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->route('spd.draft')->with('error', 'Tidak ada dokumen yang dipilih.');
        }

        // Fetch valid items owned by user
        $spds = Spd::whereIn('id', $ids)
            ->where('created_by', $userId)
            ->get();

        $count = 0;
        foreach ($spds as $spd) {
            $spd->pegawais()->detach();
            $spd->delete();
            $count++;
        }

        return redirect()->route('spd.draft')->with('success', "$count dokumen berhasil dihapus.");
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
