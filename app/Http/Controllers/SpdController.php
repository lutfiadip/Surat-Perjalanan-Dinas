<?php

namespace App\Http\Controllers;

use App\Models\PegawaiBkdSpd;
use App\Models\Penandatangan;
use App\Models\Spd;
use Illuminate\Http\Request;

class SpdController extends Controller
{
    public function create(Request $request)
    {
        // Fetch active Pegawai only
        $pegawais = PegawaiBkdSpd::where('status_aktif', true)->get();
        // Fetch active signatories from database (Kepala & Sekretaris)
        $signatories = Penandatangan::whereIn('jenis', ['kepala', 'sekretaris'])->where('status_aktif', 1)->get();

        $draft = null;
        $pegawaiUtama = null;
        $pengikuts = [];

        if ($request->has('id')) {
            $query = Spd::where('id', $request->id)->with('pegawais');

            // Allow Admin to access any, User only their own
            if (session('role') !== 'admin') {
                $query->where('created_by', session('user_id'));
            }

            $draft = $query->first();

            if ($draft) {
                // Separate Roles
                $pegawaiUtama = $draft->pegawais->where('pivot.peran', 'utama')->first();
                // Pengikuts as array of objects for easier JS handling or collection
                $pengikuts = $draft->pegawais->where('pivot.peran', 'pengikut')->values();
            }
        }

        // Fetch PPTK for preview
        $pptkModel = Penandatangan::where('jenis', 'pptk')->where('status_aktif', 1)->first();
        $pptk = [
            'nama' => $pptkModel ? $pptkModel->nama : '.......................',
            'nip' => $pptkModel ? $pptkModel->nip : '.......................',
            'jabatan' => $pptkModel ? $pptkModel->jabatan : 'Kepala Sub Bagian Umum',
        ];

        return view('spd.form', compact('pegawais', 'signatories', 'draft', 'pegawaiUtama', 'pengikuts', 'pptk'));
    }

    public function edit($id)
    {
        // 1. Ambil data pegawais untuk dropdown (ACTIVE ONLY)
        $pegawais = PegawaiBkdSpd::where('status_aktif', true)->get();

        // 2. Definisi signatories (sama seperti create)
        // Fetch active signatories from database (Kepala & Sekretaris)
        $signatories = Penandatangan::whereIn('jenis', ['kepala', 'sekretaris'])->where('status_aktif', 1)->get();

        // 3. Ambil Draft SPD berdasarkan ID & Session User
        // Admin access all, User only own
        $query = Spd::where('id', $id)->with('pegawais');

        if (session('role') !== 'admin') {
            $query->where('created_by', session('user_id'));
        }

        $draft = $query->firstOrFail();

        // 4. Pisahkan Pegawai Utama & Pengikut
        $pegawaiUtama = $draft->pegawais->where('pivot.peran', 'utama')->first();
        $pengikuts = $draft->pegawais->where('pivot.peran', 'pengikut')->values();

        // Fetch PPTK for preview
        $pptkModel = Penandatangan::where('jenis', 'pptk')->where('status_aktif', 1)->first();
        $pptk = [
            'nama' => $pptkModel ? $pptkModel->nama : '.......................',
            'nip' => $pptkModel ? $pptkModel->nip : '.......................',
            'jabatan' => $pptkModel ? $pptkModel->jabatan : 'Kepala Sub Bagian Umum',
        ];

        // 5. Return view yang sama (form.blade.php sudah support edit mode)
        return view('spd.form', compact('pegawais', 'signatories', 'draft', 'pegawaiUtama', 'pengikuts', 'pptk'));
    }

    public function store(Request $request)
    {
        $action = $request->input('action', 'draft');
        $userId = session('user_id');

        // Common Data
        // Common Data
        $data = $request->except('_token', 'pegawai_ids', 'pegawai_utama', 'pengikut', 'action', 'penandatangan');
        $data['created_by'] = $userId;
        $data['penandatangan_id'] = $request->input('penandatangan');

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
            $data['nomor_surat_tugas'] = 'SPD/' . date('Y') . '/' . date('m') . '/' . mt_rand(1000, 9999);

            // SNAPSHOT SIGNATORIES
            // 1. Main Signatory
            $signerId = $request->input('penandatangan');
            if ($signerId) {
                $signerModel = Penandatangan::find($signerId);
                if ($signerModel) {
                    $data['signatory_snapshot'] = json_encode([
                        'nama' => $signerModel->nama,
                        'nip' => $signerModel->nip,
                        'pangkat' => $signerModel->pangkat,
                        'jabatan' => $signerModel->jabatan,
                        'jenis' => $signerModel->jenis,
                    ]);
                }
            }

            // 2. PPTK Snapshot
            $pptkModel = Penandatangan::where('jenis', 'pptk')->where('status_aktif', 1)->first();
            if ($pptkModel) {
                $data['pptk_snapshot'] = json_encode([
                    'nama' => $pptkModel->nama,
                    'nip' => $pptkModel->nip,
                    'jabatan' => $pptkModel->jabatan,
                ]);
            }

        } else {
            // Draft: Minimal validation or nullable allowed
            $data['status'] = 'draft';
        }

        // Check if updating
        $spd = null;
        if ($request->has('id') && $request->id) {
            // STRICT UPDATE: Admin can update any draft, User only own
            $query = Spd::where('id', $request->id);
            if (session('role') !== 'admin') {
                $query->where('created_by', $userId);
            }
            $spd = $query->first();

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
        $draftsQuery = Spd::where('status', 'draft')->orderBy('id', 'desc')->with('creator');
        // FINALS (Arsip)
        $finalsQuery = Spd::where('status', 'final')->orderBy('id', 'desc')->with('creator');

        if (session('role') !== 'admin') {
            $draftsQuery->where('created_by', $userId);
            $finalsQuery->where('created_by', $userId);
        }

        $drafts = $draftsQuery->get();
        $finals = $finalsQuery->get();

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
        $signerId = $request->input('penandatangan');
        $signer = Penandatangan::find($signerId);

        // Fallback if not found (default to active Kepala)
        if (!$signer) {
            $signer = Penandatangan::where('jenis', 'kepala')->where('status_aktif', 1)->first();
        }

        if (!$signer) {
            abort(404, 'Data Penandatangan tidak ditemukan.');
        }

        $signatory = [
            'nama' => $signer->nama,
            'nip' => $signer->nip,
            'pangkat' => $signer->pangkat,
            'jabatan' => $signer->jabatan,
            'jabatan_head_page3' => 'Kepala Badan Keuangan Daerah',
        ];

        $tgl = $data['tanggal_surat'] ?? now()->locale('id')->isoFormat('D MMMM Y');

        // Check for Variant and Type
        $variant = $signer->variant_ttd ?? 'normal'; // Default to normal if not set
        $jenis = strtolower($signer->jenis);
        // Determine isSekretaris strictly by 'jenis' if possible, falling back to string match only if necessary (or strictly if data is clean)
        // User request: "jika jenis penandatangan di set sekre" -> Strict check on jenis.
        $isSekretaris = $jenis === 'sekretaris';

        // STRICT RENDERING LOGIC ORDER
        // 1. Plt
        // 2. Plh
        // 3. a.n. Sekretaris (Normal)
        // 4. Normal (Center)

        // Pre-calculate Title Case Name for Page 1
        $signerNamePage1 = $this->formatNameCustom($signatory['nama']);

        if ($variant === 'plt') {
            // Determine Jabatan Text based on Jenis for Plt
            $jabatanText = $signer->jabatan;
            if ($jenis === 'kepala') {
                $jabatanText = 'Kepala Badan Keuangan Daerah';
            } elseif ($jenis === 'sekretaris') {
                $jabatanText = 'Sekretaris';
            }

            // Plt. Layout
            $signatory['full_signature_page1'] = '<table style="width: 100%; border: none; border-collapse: collapse;">
                <tr><td colspan="2" style="height: 20px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="border: none; padding: 0;">' . $tgl . '</td></tr>
                <tr><td style="vertical-align: top; border: none; padding: 0;">Plt.</td><td style="vertical-align: top; border: none; padding: 0;">' . $jabatanText . '</td></tr>
                <tr><td colspan="2" style="height: 70px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="vertical-align: top; border: none; padding: 0;">' . $signerNamePage1 . '<br>' . $signer->pangkat . '<br>NIP. ' . $signer->nip . '</td></tr>
            </table>';
        } elseif ($variant === 'plh') {
            // Determine Jabatan Text based on Jenis for Plh
            $jabatanText = $signer->jabatan;
            if ($jenis === 'kepala') {
                $jabatanText = 'Kepala Badan Keuangan Daerah';
            } elseif ($jenis === 'sekretaris') {
                $jabatanText = 'Sekretaris';
            }

            // Plh. Layout
            $signatory['full_signature_page1'] = '<table style="width: 100%; border: none; border-collapse: collapse;">
                <tr><td colspan="2" style="height: 20px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="border: none; padding: 0;">' . $tgl . '</td></tr>
                <tr><td style="vertical-align: top; border: none; padding: 0;">Plh.</td><td style="vertical-align: top; border: none; padding: 0;">' . $jabatanText . '</td></tr>
                <tr><td colspan="2" style="height: 70px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="vertical-align: top; border: none; padding: 0;">' . $signerNamePage1 . '<br>' . $signer->pangkat . '<br>NIP. ' . $signer->nip . '</td></tr>
            </table>';
        } elseif ($isSekretaris && $variant === 'normal') {
            // a.n. Sekretaris Layout (Left Aligned)
            $signatory['full_signature_page1'] = '<table style="width: 100%; border: none; border-collapse: collapse;">
                <tr><td colspan="2" style="height: 20px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="border: none; padding: 0;">' . $tgl . '</td></tr>
                <tr><td style="vertical-align: top; border: none; padding: 0;">a.n.</td><td style="vertical-align: top; border: none; padding: 0;">Kepala Badan Keuangan Daerah<br>Sekretaris</td></tr>
                <tr><td colspan="2" style="height: 70px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="vertical-align: top; border: none; padding: 0;">' . $signerNamePage1 . '<br>' . $signer->pangkat . '<br>NIP. ' . $signer->nip . '</td></tr>
            </table>';
        } else {
            // Normal Layout (Left Aligned - was Center)
            // User Request: If jenis is Kepala, ignore input string and force "Kepala Badan Keuangan Daerah"
            $jabatanText = $signer->jabatan;
            if ($jenis === 'kepala') {
                $jabatanText = 'Kepala Badan Keuangan Daerah';
            }

            $signatory['full_signature_page1'] = '<table style="width: 100%; border: none; border-collapse: collapse;">
                <tr><td colspan="2" style="height: 20px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="border: none; padding: 0;">' . $tgl . '</td></tr>
                <tr><td style="vertical-align: top; border: none; padding: 0;"></td><td style="vertical-align: top; border: none; padding: 0;">' . $jabatanText . '</td></tr>
                <tr><td colspan="2" style="height: 70px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="vertical-align: top; border: none; padding: 0;">' . $signerNamePage1 . '<br>' . $signer->pangkat . '<br>NIP. ' . $signer->nip . '</td></tr>
            </table>';
        }

        // PPTK / Pejabat Pelaksana Teknis Kegiatan (Usually Kasubbag Umum as per template)
        // For dynamic signature in SPD Part I ("Berangkat dari...")
        // PPTK (Dynamic from DB)
        $pptkModel = Penandatangan::where('jenis', 'pptk')->where('status_aktif', 1)->first();
        $pptk = [
            'nama' => $pptkModel ? $pptkModel->nama : '.......................', // Fallback if missing
            'nip' => $pptkModel ? $pptkModel->nip : '.......................',
            'jabatan' => $pptkModel ? $pptkModel->jabatan : 'Kepala Sub Bagian Umum',
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
        $signerId = $request->input('penandatangan');
        $signer = Penandatangan::find($signerId);

        // Fallback or specific logic if not found (though validation should handle it)
        if (!$signer) {
            // Fallback to active kepala if possible, or error
            $signer = Penandatangan::where('jabatan', 'like', '%Kepala%')->where('status_aktif', 1)->first();
        }

        $signatory = [
            'nama' => $signer->nama,
            'nip' => $signer->nip,
            'pangkat' => $signer->pangkat,
            'jabatan' => $signer->jabatan,
            'jabatan_head_page3' => 'Kepala Badan Keuangan Daerah', // Static as per observation
        ];

        $tgl = $data['tanggal_surat'] ?? now()->locale('id')->isoFormat('D MMMM Y');

        // Check for Variant and Type
        $variant = $signer->variant_ttd ?? 'normal';
        $jenis = strtolower($signer->jenis);
        $isSekretaris = $jenis === 'sekretaris';

        // Pre-calculate Title Case Name for Page 1
        $signerNamePage1 = $this->formatNameCustom($signatory['nama']);

        if ($variant === 'plt') {
            // Determine Jabatan Text based on Jenis for Plt
            $jabatanText = $signer->jabatan;
            if ($jenis === 'kepala') {
                $jabatanText = 'Kepala Badan Keuangan Daerah';
            } elseif ($jenis === 'sekretaris') {
                $jabatanText = 'Sekretaris';
            }

            // Plt. Layout (Left Aligned)
            $signatory['full_signature_page1'] = '<table style="width: 100%; border: none; border-collapse: collapse;">
                <tr><td colspan="2" style="height: 20px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="border: none; padding: 0;">' . $tgl . '</td></tr>
                <tr><td style="vertical-align: top; border: none; padding: 0;">Plt.</td><td style="vertical-align: top; border: none; padding: 0;">' . $jabatanText . '</td></tr>
                <tr><td colspan="2" style="height: 70px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="vertical-align: top; border: none; padding: 0;">' . $signerNamePage1 . '<br>' . $signatory['pangkat'] . '<br>NIP. ' . $signatory['nip'] . '</td></tr>
            </table>';
        } elseif ($variant === 'plh') {
            // Determine Jabatan Text based on Jenis for Plh
            $jabatanText = $signer->jabatan;
            if ($jenis === 'kepala') {
                $jabatanText = 'Kepala Badan Keuangan Daerah';
            } elseif ($jenis === 'sekretaris') {
                $jabatanText = 'Sekretaris';
            }

            // Plh. Layout (Left Aligned)
            $signatory['full_signature_page1'] = '<table style="width: 100%; border: none; border-collapse: collapse;">
                <tr><td colspan="2" style="height: 20px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="border: none; padding: 0;">' . $tgl . '</td></tr>
                <tr><td style="vertical-align: top; border: none; padding: 0;">Plh.</td><td style="vertical-align: top; border: none; padding: 0;">' . $jabatanText . '</td></tr>
                <tr><td colspan="2" style="height: 70px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="vertical-align: top; border: none; padding: 0;">' . $signerNamePage1 . '<br>' . $signatory['pangkat'] . '<br>NIP. ' . $signatory['nip'] . '</td></tr>
            </table>';
        } elseif ($isSekretaris && $variant === 'normal') {
            // a.n. Sekretaris Layout (Left Aligned)
            $signatory['full_signature_page1'] = '<table style="width: 100%; border: none; border-collapse: collapse;">
                <tr><td colspan="2" style="height: 20px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="border: none; padding: 0;">' . $tgl . '</td></tr>
                <tr><td style="vertical-align: top; border: none; padding: 0;">a.n.</td><td style="vertical-align: top; border: none; padding: 0;">Kepala Badan Keuangan Daerah<br>Sekretaris</td></tr>
                <tr><td colspan="2" style="height: 70px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="vertical-align: top; border: none; padding: 0;">' . $signerNamePage1 . '<br>' . $signatory['pangkat'] . '<br>NIP. ' . $signatory['nip'] . '</td></tr>
            </table>';
        } else {
            // Normal Layout (Left Aligned - was Center)
            // User Request: If jenis is Kepala, ignore input string and force "Kepala Badan Keuangan Daerah"
            $jabatanText = $signer->jabatan;
            if ($jenis === 'kepala') {
                $jabatanText = 'Kepala Badan Keuangan Daerah';
            }

            $signatory['full_signature_page1'] = '<table style="width: 100%; border: none; border-collapse: collapse;">
                <tr><td colspan="2" style="height: 20px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="border: none; padding: 0;">' . $tgl . '</td></tr>
                <tr><td style="vertical-align: top; border: none; padding: 0;"></td><td style="vertical-align: top; border: none; padding: 0;">' . $jabatanText . '</td></tr>
                <tr><td colspan="2" style="height: 70px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="vertical-align: top; border: none; padding: 0;">' . $signerNamePage1 . '<br>' . $signatory['pangkat'] . '<br>NIP. ' . $signatory['nip'] . '</td></tr>
            </table>';
        }

        // PPTK (Dynamic from DB)
        $pptkModel = Penandatangan::where('jenis', 'pptk')->where('status_aktif', 1)->first();
        $pptk = [
            'nama' => $pptkModel ? $pptkModel->nama : '.......................', // Fallback if missing
            'nip' => $pptkModel ? $pptkModel->nip : '.......................',
            'jabatan' => $pptkModel ? $pptkModel->jabatan : 'Kepala Sub Bagian Umum',
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
        // 1. Fetch SPD
        $query = Spd::where('id', $id)
            ->where('status', 'final')
            ->with('pegawais');

        if (session('role') !== 'admin') {
            $query->where('created_by', session('user_id'));
        }

        $spd = $query->firstOrFail();

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
        $signatorySnapshot = $spd->signatory_snapshot ? json_decode($spd->signatory_snapshot, true) : null;

        if ($signatorySnapshot) {
            $signatory = [
                'nama' => $signatorySnapshot['nama'],
                'nip' => $signatorySnapshot['nip'],
                'pangkat' => $signatorySnapshot['pangkat'],
                'jabatan' => $signatorySnapshot['jabatan'],
                'jabatan_head_page3' => 'Kepala Badan Keuangan Daerah',
            ];
            // Determine layout based on 'jabatan' or 'jenis' from snapshot
            $isSekretaris = stripos($signatory['jabatan'], 'Sekretaris') !== false;
        } else {
            // Fallback to Relationship (Old behavior / Backward Compatibility)
            $signer = $spd->penandatangan;
            if (!$signer) {
                // Try to recover or default
                $signer = Penandatangan::where('jabatan', 'like', '%Kepala%')->where('status_aktif', 1)->first();
            }
            $signatory = [
                'nama' => $signer->nama,
                'nip' => $signer->nip,
                'pangkat' => $signer->pangkat,
                'jabatan' => $signer->jabatan,
                'jabatan_head_page3' => 'Kepala Badan Keuangan Daerah',
            ];
            $isSekretaris = stripos($signer->jabatan, 'Sekretaris') !== false;
        }

        // 5. Signatory Processing (with fallback to 'jenis' check)
        $variant = $signatory['variant_ttd'] ?? ($signer->variant_ttd ?? 'normal');
        $jenis = strtolower($signatory['jenis'] ?? ($signer->jenis ?? 'kepala'));
        $jabatan = $signatory['jabatan'] ?? ($signer->jabatan ?? '');

        $isSekretaris = $jenis === 'sekretaris';

        $tgl = $data['tanggal_surat'] ?? now()->locale('id')->isoFormat('D MMMM Y');

        // STRICT RENDERING LOGIC ORDER (Mirrors print/exportWord)
        // Pre-calculate Title Case Name for Page 1
        $signerNamePage1 = $this->formatNameCustom($signatory['nama']);

        if ($variant === 'plt') {
            // Determine Jabatan Text based on Jenis for Plt
            $jabatanText = $signatory['jabatan'];
            if ($jenis === 'kepala') {
                $jabatanText = 'Kepala Badan Keuangan Daerah';
            } elseif ($jenis === 'sekretaris') {
                $jabatanText = 'Sekretaris';
            }

            // Plt. Layout
            $signatory['full_signature_page1'] = '<table style="width: 100%; border: none; border-collapse: collapse;">
                <tr><td colspan="2" style="height: 20px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="border: none; padding: 0;">' . $tgl . '</td></tr>
                <tr><td style="vertical-align: top; border: none; padding: 0;">Plt.</td><td style="vertical-align: top; border: none; padding: 0;">' . $jabatanText . '</td></tr>
                <tr><td colspan="2" style="height: 70px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="vertical-align: top; border: none; padding: 0;">' . $signerNamePage1 . '<br>' . $signatory['pangkat'] . '<br>NIP. ' . $signatory['nip'] . '</td></tr>
            </table>';
        } elseif ($variant === 'plh') {
            // Determine Jabatan Text based on Jenis for Plh
            $jabatanText = $signatory['jabatan'];
            if ($jenis === 'kepala') {
                $jabatanText = 'Kepala Badan Keuangan Daerah';
            } elseif ($jenis === 'sekretaris') {
                $jabatanText = 'Sekretaris';
            }

            // Plh. Layout
            $signatory['full_signature_page1'] = '<table style="width: 100%; border: none; border-collapse: collapse;">
                <tr><td colspan="2" style="height: 20px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="border: none; padding: 0;">' . $tgl . '</td></tr>
                <tr><td style="vertical-align: top; border: none; padding: 0;">Plh.</td><td style="vertical-align: top; border: none; padding: 0;">' . $jabatanText . '</td></tr>
                <tr><td colspan="2" style="height: 70px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="vertical-align: top; border: none; padding: 0;">' . $signerNamePage1 . '<br>' . $signatory['pangkat'] . '<br>NIP. ' . $signatory['nip'] . '</td></tr>
            </table>';
        } elseif ($isSekretaris && $variant === 'normal') {
            // a.n. Sekretaris Layout
            $signatory['full_signature_page1'] = '<table style="width: 100%; border: none; border-collapse: collapse;">
                <tr><td colspan="2" style="height: 20px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="border: none; padding: 0;">' . $tgl . '</td></tr>
                <tr><td style="vertical-align: top; border: none; padding: 0;">a.n.</td><td style="vertical-align: top; border: none; padding: 0;">Kepala Badan Keuangan Daerah<br>Sekretaris</td></tr>
                <tr><td colspan="2" style="height: 70px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="vertical-align: top; border: none; padding: 0;">' . $signatory['nama'] . '<br>' . $signatory['pangkat'] . '<br>NIP. ' . $signatory['nip'] . '</td></tr>
            </table>';
        } else {
            // Normal Layout (Left Aligned - was Center)
            // User Request: If jenis is Kepala, ignore input string and force "Kepala Badan Keuangan Daerah"
            $jabatanText = $signatory['jabatan'];
            if ($jenis === 'kepala') {
                $jabatanText = 'Kepala Badan Keuangan Daerah';
            }
            $signatory['full_signature_page1'] = '<table style="width: 100%; border: none; border-collapse: collapse;">
                <tr><td colspan="2" style="height: 20px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="border: none; padding: 0;">' . $tgl . '</td></tr>
                <tr><td style="vertical-align: top; border: none; padding: 0;"></td><td style="vertical-align: top; border: none; padding: 0;">' . $jabatanText . '</td></tr>
                <tr><td colspan="2" style="height: 70px; border: none;">&nbsp;</td></tr>
                <tr><td style="width: 30px; border: none; padding: 0;">&nbsp;</td><td style="vertical-align: top; border: none; padding: 0;">' . $signerNamePage1 . '<br>' . $signatory['pangkat'] . '<br>NIP. ' . $signatory['nip'] . '</td></tr>
            </table>';
        }

        // 6. PPTK (Snapshot or Dynamic)
        $pptkSnapshot = $spd->pptk_snapshot ? json_decode($spd->pptk_snapshot, true) : null;
        if ($pptkSnapshot) {
            $pptk = [
                'nama' => $pptkSnapshot['nama'],
                'nip' => $pptkSnapshot['nip'],
                'jabatan' => $pptkSnapshot['jabatan'],
            ];
        } else {
            $pptkModel = Penandatangan::where('jenis', 'pptk')->where('status_aktif', 1)->first();
            $pptk = [
                'nama' => $pptkModel ? $pptkModel->nama : '.......................',
                'nip' => $pptkModel ? $pptkModel->nip : '.......................',
                'jabatan' => $pptkModel ? $pptkModel->jabatan : 'Kepala Sub Bagian Umum',
            ];
        }

        return compact('selectedPegawais', 'data', 'signatory', 'pptk');
    }

    public function destroy($id)
    {
        $userId = session('user_id');

        // STRICT: Admin can delete any, User only own
        $query = Spd::where('id', $id);
        if (session('role') !== 'admin') {
            $query->where('created_by', $userId);
        }
        $spd = $query->firstOrFail();

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

        // Fetch valid items owned by user (or any for admin)
        $query = Spd::whereIn('id', $ids);
        if (session('role') !== 'admin') {
            $query->where('created_by', $userId);
        }
        $spds = $query->get();

        $count = 0;
        foreach ($spds as $spd) {
            /** @var Spd $spd */
            $spd->pegawais()->detach();
            $spd->delete();
            $count++;
        }

        return redirect()->route('spd.draft')->with('success', "$count dokumen berhasil dihapus.");
    }

    private function formatNameCustom($name)
    {
        // "Huruf pertama tiap kata besar selanjutnya kecil" ONLY for the Name part (before comma)
        // Preserves titles (after comma) exactly as is.
        $parts = explode(',', $name, 2);

        // Title Case the first part (Name)
        $formattedName = ucwords(strtolower($parts[0]));

        // If there's a second part (Titles), append it exactly as received
        if (isset($parts[1])) {
            return $formattedName . ',' . $parts[1];
        }

        return $formattedName;
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
