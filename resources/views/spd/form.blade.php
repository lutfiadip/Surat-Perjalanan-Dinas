<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input SPD</title>
    <!-- GLOBAL ERROR HANDLER -->
    <script>
        window.onerror = function(message, source, lineno, colno, error) {
            alert("JS Error di baris " + lineno + ":\n" + message);
        };
    </script>
    <!-- Injected JS -->
    <style>
        {!! file_get_contents(public_path('css/select2.min.css')) !!}
    </style>
    <script>
        // NativePHP/Electron injects `module` which breaks jQuery/Select2 UMD wrappers.
        // We hide them temporarily so they attach to `window`.
        var _module = window.module;
        var _exports = window.exports;
        window.module = undefined;
        window.exports = undefined;
    </script>
    <script>
        {!! file_get_contents(public_path('js/jquery.min.js')) !!}
    </script>
    <script>
        {!! file_get_contents(public_path('js/select2.min.js')) !!}
    </script>
    <script>
        window.module = _module;
        window.exports = _exports;
    </script>

    @vite(['resources/css/app.css'])

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #1C6DD0;
            /* User: 1C6DD0 (Blue) */
            --primary-hover: #1653a1;
            /* Darker Blue */
            --accent: #1C6DD0;
            --bg-color: #FFF8F3;
            /* User: FFF8F3 (Cream/White) */
            --text-color: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --input-bg: #ffffff;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            line-height: 1.5;
            padding: 2rem;
            margin: 0;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Horizontally center content */
            justify-content: center;
            /* Vertically center content */
        }

        .container {
            width: 100%;
            margin: auto;
            /* Allow flex to handle centering, but auto margins help with vertical if needed */
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(8px);
            padding: 2rem;
            border-radius: 1rem;
            /* rounded-2xl */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.5);
            display: block;
            /* Default to block (single column) */
            max-width: 800px;
            /* Restrict width for better single-form readability */
        }

        /* When preview is active */
        .container.with-preview {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 550px; /* Use minmax(0, 1fr) to prevent flex/grid item expansion issues */
            max-width: 95vw;
            gap: 2rem;
            align-items: start; /* Ensure top alignment */
        }

        .form-section {
            /* Left side */
        }

        .form-section h3 {
            margin-top: 0;
        }

        /* Utility classes for section cards and separators */
        .bg-white { background-color: var(--input-bg); }
        .p-6 { padding: 1.5rem; }
        .rounded-xl { border-radius: 0.75rem; }
        .border { border: 1px solid var(--border-color); }
        .border-slate-200 { border-color: var(--border-color); }
        .border-slate-100 { border-color: #f1f5f9; }
        .shadow-sm { box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); }
        .mb-2 { margin-bottom: 0.5rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        .pb-2 { padding-bottom: 0.5rem; }
        .border-b { border-bottom: 1px solid var(--border-color); }
        .text-lg { font-size: 1.125rem; }
        .font-bold { font-weight: 700; }
        .text-slate-800 { color: var(--text-color); }
        .text-slate-500 { color: var(--text-muted); }
        .text-sm { font-size: 0.875rem; }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-color);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.625rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            /* rounded-lg */
            font-size: 1rem;
            box-sizing: border-box;
            /* Important for padding */
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #999;
        }

        .form-group select:invalid {
            color: #999;
        }

        .form-group select option {
            color: var(--text-color);
        }

        .form-group select {
            background-color: #f1f5f9;
        }



        .form-group textarea {
            resize: vertical;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(28, 109, 208, 0.1);
        }

        /* Fix for Select2 to match regular inputs */
        .select2-container .select2-selection--single,
        .select2-container .select2-selection--multiple {
            min-height: 42px;
            padding: 4px;
            border: 1px solid var(--border-color) !important;
            border-radius: 0.5rem !important;
            background-color: #f1f5f9 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 32px;
            color: var(--text-color);
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 0.75rem;
            /* rounded-xl */
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 1rem;
        }

        .btn:hover {
            background-color: var(--primary-hover);
        }

        /* Background Blobs */
        .bg-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            z-index: -1;
            opacity: 0.6;
            pointer-events: none;
        }

        .blob-blue {
            background: rgba(163, 228, 219, 0.6);
            /* User: A3E4DB (Cyan) */
            width: 500px;
            height: 500px;
            top: -100px;
            right: -100px;
        }

        .blob-indigo {
            background: rgba(254, 209, 239, 0.6);
            /* User: FED1EF (Pink) */
            width: 300px;
            height: 300px;
            top: 50px;
            left: -50px;
        }

        .blob-slate {
            background: rgba(28, 109, 208, 0.2);
            /* User: 1C6DD0 (Blue) - Low Opacity */
            width: 600px;
            height: 600px;
            bottom: -100px;
            right: -100px;
            transform: none;
        }

        /* PREVIEW STYLES (Moved from preview.blade.php) */
        .preview-section {
            display: none; /* HEADER FIX: Ensure hidden by default */
            background: #525659;
            padding: 15px;
            border-radius: 8px;
            height: calc(100vh - 40px);
            overflow-y: auto;
            overflow-x: auto;
            position: sticky;
            top: 20px;
        }

        .container.with-preview .preview-section {
            display: block;
            /* Ensure it's visible when parent has class */
        }

        .paper {
            background: white;
            width: 210mm;
            min-height: 297mm;
            padding: 15mm 20mm;
            margin: 0 auto 20px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            line-height: 1.15;
            color: #000;
            box-sizing: border-box;
            display: block;
            zoom: 0.63;
        }

        .preview-content-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .paper p {
            margin: 2px 0;
        }

        .paper table {
            width: 100%;
            border-collapse: collapse;
        }

        .paper td {
            vertical-align: top;
            padding: 2px;
        }

        @media (max-width: 768px) {
            .container.with-preview {
                grid-template-columns: 1fr;
                /* Stack on mobile */
            }

            .preview-section {
                display: none;
                /* By default hidden on mobile unless active? Or standard behavior */
                position: static;
                height: auto;
                max-height: 800px;
            }
            
            /* If with-preview is on mobile, show it */
            .container.with-preview .preview-section {
                display: block;
            }

            .paper {
                transform: scale(0.9);
                margin-bottom: -30mm;
                zoom: 1;
                transform-origin: top left; /* Fix transform origin */
            }
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: black;
        }

        .btn-draft {
            background-color: #64748b;
        }

        .btn-draft:hover {
            background-color: #475569; /* Slate 600 */
        }

        .btn-danger {
            background-color: #ef4444 !important;
        }

        .btn-danger:hover {
            background-color: #dc2626 !important; /* Red 600 */
        }
    </style>
</head>

<body>
    <!-- Background Elements -->
    <div class="bg-blob blob-blue"></div>
    <div class="bg-blob blob-indigo"></div>
    <div class="bg-blob blob-slate"></div>

    <div class="container">
        <!-- LEFT COLUMN: INPUT FORM -->
        <div class="form-section">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <a href="{{ route('spd.index') }}" class="back-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5"></path>
                        <path d="M12 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Halaman Dokumen
                </a>

            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h1 style="margin: 0;">Buat SPD</h1>
                <button type="button" id="btn-toggle-preview" class="btn">
                    Lihat Preview
                </button>
            </div>

            <form id="spdForm" action="{{ route('spd.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $draft->id ?? '' }}">
                <input type="hidden" name="status" value="draft">

                <!-- Backend Conflict Warning Display -->
                @if($errors->has('pegawai_conflict'))
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl shadow-sm" role="alert">
                        <div class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-0.5 flex-shrink-0 text-red-600" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                            <div>
                                <span class="text-sm font-bold text-red-800">Peringatan Bentrok Jadwal (Backend):</span>
                                <div class="text-sm mt-1">{!! $errors->first('pegawai_conflict') !!}</div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Dynamic AJAX Warning Container -->
                <div id="conflict-warning-container" style="display: none;"></div>

                <!-- SECTION 1: INFORMASI SURAT -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm mb-6">
                    <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-2 mb-4">1. Informasi Surat</h3>
                    <div class="grid" style="grid-template-columns: 1fr 1fr 1fr;">
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" name="nomor_surat" placeholder="contoh:        /        / XII / 2025" value="{{ old('nomor_surat', $draft->nomor_surat ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" value="{{ old('tanggal_surat', $draft->tanggal_surat ?? now()->format('Y-m-d')) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Tahun Anggaran</label>
                            <input type="number" name="tahun_anggaran" value="{{ old('tahun_anggaran', $draft->tahun_anggaran ?? date('Y')) }}" required>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: DASAR DAN MAKSUD PENUGASAN -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm mb-6">
                    <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-2 mb-2">2. Dasar dan Maksud Penugasan</h3>
                    <p class="text-sm text-slate-500 mb-4">Isi sesuai surat undangan atau perintah yang diterima.</p>
                    
                    <div class="form-group">
                        <label>Dasar Surat (Untuk "Berdasarkan")</label>
                        <textarea name="dasar_surat" rows="2"
                            placeholder="Contoh: Surat dari... Nomor: ... perihal ...">{{ old('dasar_surat', $draft->dasar_surat ?? '') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Untuk (Maksud Perjalanan Dinas)</label>
                        <textarea name="maksud" rows="2" required
                            placeholder="Contoh: Menghadiri Rekonsiliasi Opsen Pajak Daerah">{{ old('maksud', $draft->maksud ?? '') }}</textarea>
                    </div>
                </div>

                <!-- SECTION 3: PEGAWAI YANG DITUGASKAN -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm mb-6">
                    <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-2 mb-4">3. Pegawai yang Ditugaskan</h3>
                    
                    <div class="form-group">
                        <label>Pilih Pegawai Utama</label>
                        <div id="pegawai-wrapper">
                            <div class="pegawai-row" style="margin-bottom: 10px; display: flex; gap: 10px;">
                                <select name="pegawai_utama" required style="flex: 1;" class="select2-pegawai"
                                    onchange="updatePreview()">
                                    <option value="">-- Pilih Pegawai Utama --</option>
                                    @foreach($pegawais as $pegawai)
                                        <option value="{{ $pegawai->id }}" data-nama="{{ $pegawai->nama }}"
                                            data-nip="{{ $pegawai->nip }}" data-pangkat="{{ $pegawai->pangkat_gol }}"
                                            data-jabatan="{{ $pegawai->jabatan }}"
                                            {{ (isset($pegawaiUtama) && $pegawaiUtama->id == $pegawai->id) ? 'selected' : '' }}>
                                            {{ $pegawai->nama }} ({{ $pegawai->nip }})
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" id="btn-clear-pegawai-utama" class="btn btn-danger" onclick="$('select[name=\'pegawai_utama\']').val('').trigger('change');" style="display: none; width: 50px; padding: 0; flex-shrink: 0; align-items: center; justify-content: center;" title="Kosongkan Pegawai Utama">X</button>
                            </div>
                        </div>
                        <button type="button" id="btn-add-pegawai" onclick="addPegawai()" class="btn"
                            style="display: none; width: auto; padding: 0.5rem 1rem; font-size: 0.9rem;">
                            + Tambah Pengikut
                        </button>
                        <p class="multi-select-note" style="margin-top: 10px;">Pegawai pertama adalah Pegawai Utama,
                            selanjutnya adalah Pengikut.</p>
                    </div>
                </div>

                <!-- SECTION 4: INFORMASI KEGIATAN -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm mb-6">
                    <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-2 mb-4">4. Informasi Kegiatan</h3>
                    
                    <div class="grid">
                        <div class="form-group">
                            <label>Hari</label>
                            <input type="text" id="hari" name="hari" value="{{ now()->locale('id')->isoFormat('dddd') }}"
                                required readonly style="background-color: var(--border-color);">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kegiatan</label>
                            <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan"
                                value="{{ old('tanggal_kegiatan', $draft->tanggal_kegiatan ?? now()->format('Y-m-d')) }}" required oninput="updateDay()">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tempat Kegiatan</label>
                        <textarea name="tempat" rows="2" required placeholder="Contoh: Bank Jateng KCU Surakarta. Jl. Slamet Riyadi No 20 Surakarta">{{ old('tempat', $draft->tempat ?? '') }}</textarea>
                    </div>
                </div>

                <!-- SECTION 5: DETAIL PERJALANAN DINAS -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm mb-6">
                    <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-2 mb-2">5. Detail Perjalanan Dinas</h3>
                    <p class="text-sm text-slate-500 mb-4">Isi informasi perjalanan sesuai pelaksanaan dinas.</p>

                    <div class="form-group">
                        <label>Tingkat Biaya Perjalanan Dinas</label>
                        <input type="text" name="tingkat_biaya" placeholder="Kosongkan jika tidak ada" value="{{ old('tingkat_biaya', $draft->tingkat_biaya ?? '') }}">
                    </div>

                    <div class="grid">
                        <div class="form-group">
                            <label>Alat Angkut</label>
                            <input type="text" name="alat_angkut" placeholder="Contoh: Kendaraan Dinas" value="{{ old('alat_angkut', $draft->alat_angkut ?? '') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Lama Perjalanan (Hari)</label>
                            <input type="number" id="lama_perjalanan" name="lama_perjalanan" placeholder="Contoh: 1" value="{{ old('lama_perjalanan', $draft->lama_perjalanan ?? '') }}" min="1" required
                                oninput="calculateReturnDate()">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tempat Berangkat</label>
                        <input type="text" name="tempat_berangkat" placeholder="Contoh: BKD Karanganyar" value="{{ old('tempat_berangkat', $draft->tempat_berangkat ?? '') }}" required>
                    </div>

                    <div class="grid">
                        <div class="form-group">
                            <label>Tanggal Berangkat</label>
                            <input type="date" id="tgl_berangkat" name="tgl_berangkat" value="{{ old('tgl_berangkat', $draft->tgl_berangkat ?? now()->format('Y-m-d')) }}"
                                required oninput="calculateReturnDate()">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Harus Kembali</label>
                            <input type="date" id="tgl_kembali" name="tgl_kembali" value="{{ old('tgl_kembali', $draft->tgl_kembali ?? now()->format('Y-m-d')) }}"
                                required readonly style="background-color: var(--border-color); cursor: not-allowed;">
                        </div>
                    </div>
                </div>

                <!-- SECTION 6: PEMBIAYAAN DAN ANGGARAN -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm mb-6">
                    <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-2 mb-4">6. Pembiayaan dan Anggaran</h3>
                    
                    <div class="grid">
                        <div class="form-group">
                            <label>Pembebanan Anggaran (SKPD)</label>
                            <input type="text" name="anggaran_skpd" placeholder="Contoh: Badan Keuangan Daerah" value="{{ old('anggaran_skpd', $draft->anggaran_skpd ?? '') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Kode Rekening</label>
                            <input type="text" name="kode_rekening" placeholder="Kosongkan jika tidak ada" value="{{ old('kode_rekening', $draft->kode_rekening ?? '') }}">
                        </div>
                    </div>
                </div>

                <!-- SECTION 7: KETERANGAN TAMBAHAN -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm mb-6">
                    <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-2 mb-4">7. Keterangan Tambahan</h3>
                    
                    <div class="form-group">
                        <label>Keterangan Lain-Lain</label>
                        <textarea name="keterangan_lain" rows="2" placeholder="Kosongkan jika tidak ada">{{ old('keterangan_lain', $draft->keterangan_lain ?? '') }}</textarea>
                    </div>
                </div>

                <!-- SECTION 8: PENGESAHAN SURAT -->
                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm mb-6">
                    <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-2 mb-4">8. Pengesahan Surat</h3>
                    
                    <!-- Pejabat Pelaksana Teknis Kegiatan (PPTK) Manual Inputs -->
                    <div style="margin-bottom: 1.5rem; display: flex; flex-direction: column; gap: 0.75rem;">
                        <h4 style="font-size: 0.95rem; font-weight: 600; color: var(--text-color); margin: 0; border-bottom: 1px solid var(--border-color); padding-bottom: 0.25rem;">Pejabat Pelaksana Teknis Kegiatan (PPTK)</h4>
                        
                        <div class="form-group" style="margin-bottom: 0; position: relative;">
                            <label>Pilih PPTK (Master Data)</label>
                            <div style="position: relative;">
                                <select name="pptk_id" id="pptk_select" class="form-control"
                                    style="width: 100%; padding: 0.75rem; padding-right: 2.5rem; border: 1px solid var(--border-color); border-radius: 0.375rem; appearance: none; background-color: transparent; position: relative; z-index: 10;"
                                    onfocus="this.nextElementSibling.style.transform='translateY(-50%) rotate(180deg)'" 
                                    onblur="this.nextElementSibling.style.transform='translateY(-50%) rotate(0deg)'"
                                    onchange="this.nextElementSibling.style.transform='translateY(-50%) rotate(0deg)'; this.blur();">
                                    <option value="">-- Input Manual / Lainnya --</option>
                                    @foreach($pptks as $p)
                                        <option value="{{ $p->id }}"
                                            data-nama="{{ $p->nama }}"
                                            data-nip="{{ $p->nip }}"
                                            data-jabatan="{{ $p->jabatan }}"
                                            data-bidang="Sekretariat"
                                            {{ (isset($selectedPptkId) && $selectedPptkId == $p->id) ? 'selected' : '' }}>
                                            {{ $p->nama }} ({{ $p->nip }})
                                        </option>
                                    @endforeach
                                </select>
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="#888" stroke="none" 
                                    style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); transition: transform 0.2s ease; pointer-events: none; z-index: 1;">
                                    <polygon points="4,8 20,8 12,17"></polygon>
                                </svg>
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 0;">
                            <label>Nama PPTK</label>
                            <input type="text" name="pptk_nama" id="pptk_nama" placeholder="Nama lengkap & gelar" value="{{ old('pptk_nama', $pptk['nama'] ?? '') }}" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label>NIP PPTK</label>
                            <input type="text" name="pptk_nip" id="pptk_nip" placeholder="NIP PPTK" value="{{ old('pptk_nip', $pptk['nip'] ?? '') }}" required>
                        </div>
                        <div class="grid">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label>Jabatan PPTK</label>
                                <input type="text" name="pptk_jabatan" id="pptk_jabatan" placeholder="Contoh: Kepala Sub Bagian Umum" value="{{ old('pptk_jabatan', $pptk['jabatan'] ?? '') }}" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <label>Bidang PPTK</label>
                                <input type="text" name="pptk_bidang" id="pptk_bidang" placeholder="Contoh: Sekretariat" value="{{ old('pptk_bidang', $pptk['bidang'] ?? 'Sekretariat') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <h4 style="font-size: 0.95rem; font-weight: 600; color: var(--text-color); margin: 0; border-bottom: 1px solid var(--border-color); padding-bottom: 0.25rem;">Penandatangan Surat (SPT)</h4>
                        <div style="position: relative;">
                            <select name="penandatangan" class="form-control" required
                                style="width: 100%; padding: 0.75rem; padding-right: 2.5rem; border: 1px solid var(--border-color); border-radius: 0.375rem; appearance: none; background-color: transparent; position: relative; z-index: 10;"
                                onfocus="this.nextElementSibling.style.transform='translateY(-50%) rotate(180deg)'" 
                                onblur="this.nextElementSibling.style.transform='translateY(-50%) rotate(0deg)'"
                                onchange="this.nextElementSibling.style.transform='translateY(-50%) rotate(0deg)'; this.blur();">
                                <option value="" disabled {{ !isset($draft) || empty($draft->penandatangan_id) ? 'selected' : '' }}>-- Pilih Penandatangan --</option>
                                @foreach($signatories as $signer)
                                    <option value="{{ $signer->id }}" 
                                        data-nama="{{ $signer->nama }}"
                                        data-nip="{{ $signer->nip }}"
                                        data-pangkat="{{ $signer->pangkat }}"
                                        data-jabatan="{{ $signer->jabatan }}"
                                        data-variant="{{ $signer->variant_ttd ?? 'normal' }}"
                                        data-jenis="{{ $signer->jenis }}"
                                        {{ (isset($draft) && $draft->penandatangan_id == $signer->id) ? 'selected' : '' }}>
                                        @php
                                            $variantSuffix = '';
                                            if ($signer->variant_ttd && strtolower($signer->variant_ttd) !== 'normal') {
                                                $jenisText = '';
                                                if ($signer->jenis && strtolower($signer->jenis) === 'kepala') {
                                                    $jenisText = ' Kepala Badan';
                                                } elseif ($signer->jenis && strtolower($signer->jenis) === 'sekretaris') {
                                                    $jenisText = ' Sekretaris';
                                                }
                                                $variantSuffix = ' (' . strtoupper($signer->variant_ttd) . $jenisText . ')';
                                            }
                                        @endphp
                                        {{ $signer->jabatan }} - {{ $signer->nama }}{{ $variantSuffix }}
                                    </option>
                                @endforeach
                            </select>
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="#888" stroke="none" 
                                style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); transition: transform 0.2s ease; pointer-events: none; z-index: 1;">
                                <polygon points="4,8 20,8 12,17"></polygon>
                            </svg>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 1rem;">
                    @if(isset($draft) && $draft->status == 'final' && \Carbon\Carbon::parse($draft->tgl_berangkat)->startOfDay()->lt(\Carbon\Carbon::today()))
                        {{-- Final Mode & Passed: Print & Export Only --}}
                        <a href="{{ route('spd.print.final', ['id' => $draft->id]) }}" target="_blank" class="btn" style="text-decoration: none; text-align: center;">Cetak Surat</a>
                        <a href="{{ route('spd.export_word.final', ['id' => $draft->id]) }}" class="btn" style="text-decoration: none; text-align: center;">Export Word</a>
                    @else
                        {{-- Draft Mode OR Final & Not Passed: Save Actions --}}
                        <button type="submit" name="action" value="draft" class="btn btn-draft" formnovalidate>Simpan Draft</button>
                        <button type="submit" name="action" value="final" class="btn">Simpan Final</button>
                    @endif
                </div>
            </form>
        </div>

        <!-- End .form-section -->

        <!-- RIGHT COLUMN: PREVIEW -->
        @include('spd.preview')

    </div> <!-- End .container -->

    <script>
        const signatories = @json($signatories);
        const pptks = @json($pptks ?? []);
        const existingPengikuts = @json($pengikuts ?? []);

        function initSpdForm() {
            // Toggle Preview Handler
            $('#btn-toggle-preview').on('click', function () {
                const container = $('.container');
                const btn = $(this);

                container.toggleClass('with-preview');

                if (container.hasClass('with-preview')) {
                    btn.html('Tutup Preview');
                    btn.addClass('btn-danger');
                } else {
                    btn.html('Lihat Preview');
                    btn.removeClass('btn-danger'); // Reset to default class style
                }
            });

            // Initialize Select2 on existing selects
            $('.select2-pegawai').select2({
                placeholder: "-- Pilih Pegawai Utama --",
                width: '100%'
            }).on('change', function () {
                updatePreview();
                if ($(this).attr('name') === 'pegawai_utama') {
                    if ($(this).val()) {
                        $('#btn-add-pegawai').show();
                        $('#btn-clear-pegawai-utama').css('display', 'flex');
                    } else {
                        $('#btn-add-pegawai').hide();
                        $('#btn-clear-pegawai-utama').hide();
                    }
                }
                checkScheduleConflict();
            });

            // Initial visibility for Tambah Pengikut
            if ($('select[name="pegawai_utama"]').val()) {
                $('#btn-add-pegawai').show();
                $('#btn-clear-pegawai-utama').css('display', 'flex');
            } else {
                $('#btn-add-pegawai').hide();
                $('#btn-clear-pegawai-utama').hide();
            }

            // Handle PPTK Selection Change
            function handlePptkSelect(selectEl, isOnChange = false) {
                const selected = $(selectEl).find('option:selected');
                const id = $(selectEl).val();

                if (id) {
                    $('#pptk_nama').val(selected.data('nama')).prop('readonly', true).css('background-color', 'var(--border-color)');
                    $('#pptk_nip').val(selected.data('nip')).prop('readonly', true).css('background-color', 'var(--border-color)');
                    $('#pptk_jabatan').val(selected.data('jabatan')).prop('readonly', true).css('background-color', 'var(--border-color)');
                    $('#pptk_bidang').val(selected.data('bidang')).prop('readonly', true).css('background-color', 'var(--border-color)');
                } else {
                    $('#pptk_nama').prop('readonly', false).css('background-color', '');
                    $('#pptk_nip').prop('readonly', false).css('background-color', '');
                    $('#pptk_jabatan').prop('readonly', false).css('background-color', '');
                    $('#pptk_bidang').prop('readonly', false).css('background-color', '');

                    if (isOnChange) {
                        $('#pptk_nama').val('');
                        $('#pptk_nip').val('');
                        $('#pptk_jabatan').val('');
                        $('#pptk_bidang').val('');
                    }
                }
            }

            $('#pptk_select').on('change', function () {
                handlePptkSelect(this, true);
                updatePreview();
            });

            // Trigger check on load
            handlePptkSelect('#pptk_select', false);

            // Populate Pengikut
            if (Array.isArray(existingPengikuts) && existingPengikuts.length > 0) {
                existingPengikuts.forEach(function(p) {
                    addPegawai(p.id);
                });
            }

            // Initial Preview Update
            updatePreview();
            updateDay();

            // Bind Input Events
            $('input, textarea, select').on('input change', function () {
                updatePreview();
            });

            // Bind conflict checks on date / duration changes
            $('#tgl_berangkat, #lama_perjalanan').on('input change', function() {
                checkScheduleConflict();
            });

            // Track last clicked submit button
            let lastClickedSubmitButton = null;
            $('button[type="submit"]').on('click', function() {
                lastClickedSubmitButton = this;
            });

            // Intercept form submission to warn if bentrok, but still allow finalization with confirmation
            $('#spdForm').on('submit', function (e) {
                const action = lastClickedSubmitButton ? $(lastClickedSubmitButton).val() : $(document.activeElement).val();
                
                if (action === 'final') {
                    let confirmMessage = 'Apakah Anda yakin ingin memfinalisasi dokumen ini? Dokumen yang sudah final tidak dapat diedit lagi.';
                    
                    if (hasActiveConflict) {
                        confirmMessage = 'Peringatan: Terdapat jadwal bentrok untuk pegawai yang dipilih. Apakah Anda yakin ingin tetap memfinalisasi dokumen ini?';
                    }
                    
                    if (!confirm(confirmMessage)) {
                        e.preventDefault();
                        
                        if (hasActiveConflict) {
                            // Scroll to warning container
                            $('html, body').animate({
                                scrollTop: $("#conflict-warning-container").offset().top - 100
                            }, 500);
                        }
                        
                        return false;
                    }
                }
            });

            // Initial check on page load (specifically when editing draft)
            checkScheduleConflict();
        }
        function updatePreview() {
            // --- DATA GATHERING ---
            const nomor = $('[name="nomor_surat"]').val();
            const dasar = nl2br($('[name="dasar_surat"]').val());
            const maksud = nl2br($('[name="maksud"]').val());
            const hari = $('[name="hari"]').val();
            const tempat = nl2br($('[name="tempat"]').val());
            const tahun = $('[name="tahun_anggaran"]').val();
            const biaya = $('[name="tingkat_biaya"]').val();
            const alat = $('[name="alat_angkut"]').val();
            const lama = $('[name="lama_perjalanan"]').val();
            const berangkat = $('[name="tempat_berangkat"]').val();
            const skpd = $('[name="anggaran_skpd"]').val();
            const rekening = $('[name="kode_rekening"]').val();
            const ketLain = nl2br($('[name="keterangan_lain"]').val());

            const tglKegiatan = formatDateIndo($('[name="tanggal_kegiatan"]').val());
            const tglSurat = formatDateIndo($('[name="tanggal_surat"]').val());
            const tglBerangkat = formatDateIndo($('[name="tgl_berangkat"]').val());
            const tglKembali = formatDateIndo($('[name="tgl_kembali"]').val());

            // Get Signatory Data from Selected Option
            const signSelect = $('[name="penandatangan"]');
            const selectedSigner = signSelect.find('option:selected');
            
            const signer = {
                nama: selectedSigner.data('nama') || '',
                nip: selectedSigner.data('nip') || '',
                pangkat: selectedSigner.data('pangkat') || '',
                jabatan: selectedSigner.data('jabatan') || '',
                variant: selectedSigner.data('variant') || 'normal',
                jenis: selectedSigner.data('jenis') || ''
            };

            // Get PPTK Data from Manual Inputs
            const pptk = {
                nama: $('[name="pptk_nama"]').val() || '.......................',
                nip: $('[name="pptk_nip"]').val() || '.......................',
                jabatan: $('[name="pptk_jabatan"]').val() || '.......................',
                bidang: $('[name="pptk_bidang"]').val() || '.......................',
            };
            
            // Allow Title Case logic if needed, but for now use raw name from DB
            signer.nama_title = signer.nama; 

            // --- PAGE 1: SURAT TUGAS ---
            $('#preview-nomor').text(nomor);
            // Process Dasar Surat with special justification for "Nomor:" splitting
            let dasarHtml = '<div style="text-align: justify; text-align-last: left;">' +
                dasar.replace('Nomor:', '</div><div style="text-align: justify; text-align-last: left;">Nomor:') +
                '</div>';
            $('#preview-dasar-container').html(dasarHtml);
            $('#preview-maksud').html(maksud);
            $('#preview-hari').text(hari);
            $('#preview-tempat').html(tempat);
            $('#preview-tahun').text(tahun);

            $('#preview-tgl-kegiatan').text(tglKegiatan);
            $('#preview-tgl-surat').text(tglSurat);

            // Signatory Page 1
            // Signatory Page 1 Logic
            // Signatory Page 1 Logic
            const signContainer = $('#preview-signature-container');
            let signHtml = '';

            // Helper to determine type - STRICT checking on jenis as requested
            const variant = signer.variant;
            const isSekretaris = signer.jenis && signer.jenis.toLowerCase() === 'sekretaris';

            // Helper for Title Case (Name formatting only, preserve titles)
            const toTitleCase = (str) => {
                if (!str) return '';
                const commaIndex = str.indexOf(',');
                let namePart = str;
                let titlePart = '';

                if (commaIndex > -1) {
                    namePart = str.substring(0, commaIndex);
                    titlePart = str.substring(commaIndex);
                }

                let formattedName = namePart.toLowerCase().split(' ').map(function(word) {
                    return (word.charAt(0).toUpperCase() + word.slice(1));
                }).join(' ');

                return formattedName + titlePart;
            };

            const signerNamePage1 = toTitleCase(signer.nama_title);

            // 1. Plt/Plh or Sekretaris layout
            if (isSekretaris) {
                let prefix = '';
                if (variant === 'plt') {
                    prefix = 'Plt. ';
                } else if (variant === 'plh') {
                    prefix = 'Plh. ';
                }

                signHtml = `
                <table style="width: 100%; border: none; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 11pt;">
                     <tr>
                        <td colspan="2" style="height: 10px; border: none;"></td>
                    </tr>
                    <tr>
                        <td style="width: 30px; border: none; padding: 0;"></td>
                        <td style="border: none; padding: 0;">${tglSurat}</td>
                    </tr>
                     <tr>
                        <td style="vertical-align: top; border: none; padding: 0;">a.n.</td>
                        <td style="vertical-align: top; border: none; padding: 0;">
                            Kepala Badan Keuangan Daerah<br>
                            ${prefix}Sekretaris
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 60px; border: none;"></td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 0;"></td>
                         <td style="vertical-align: top; border: none; padding: 0;">
                            ${signerNamePage1}<br>
                            ${signer.pangkat}<br>
                            NIP. ${signer.nip}
                        </td>
                    </tr>
                </table>`;
            } else {
                // Kepala or Kabid
                let prefix = '';
                if (variant === 'plt') {
                    prefix = 'Plt.';
                } else if (variant === 'plh') {
                    prefix = 'Plh.';
                }

                let jabatanText = signer.jabatan || '';
                if (signer.jenis && signer.jenis.toLowerCase() === 'kepala') {
                    jabatanText = 'Kepala Badan Keuangan Daerah';
                }

                signHtml = `
                <table style="width: 100%; border: none; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 11pt;">
                     <tr>
                        <td colspan="2" style="height: 10px; border: none;"></td>
                    </tr>
                    <tr>
                        <td style="width: 30px; border: none; padding: 0;"></td>
                        <td style="border: none; padding: 0;">${tglSurat}</td>
                    </tr>
                     <tr>
                        <td style="vertical-align: top; border: none; padding: 0;">${prefix}</td>
                        <td style="vertical-align: top; border: none; padding: 0;">
                            ${jabatanText}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 60px; border: none;"></td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 0;"></td>
                        <td style="vertical-align: top; border: none; padding: 0;">
                            ${signerNamePage1}<br>
                            ${signer.pangkat}<br>
                            NIP. ${signer.nip}
                        </td>
                    </tr>
                </table>`;
            }

            signContainer.html(signHtml);

            // --- PAGE 2: SPD ---
            $('#preview-spd-maksud').html(maksud);
            $('#preview-spd-alat').text(alat);
            $('#preview-spd-berangkat').text(berangkat);
            $('#preview-spd-tujuan').html(tempat);
            const textLama = lama ? `${lama} (${terbilang(parseInt(lama)).trim()})` : '...';
            $('#preview-spd-lama').text(textLama);
            $('#preview-spd-tgl-berangkat').text(tglBerangkat);
            $('#preview-spd-tgl-kembali').text(tglKembali);
            $('#preview-spd-skpd').text(skpd);
            $('#preview-spd-rekening').text(rekening);
            $('#preview-spd-ket').html(ketLain);
            $('#preview-spd-biaya').text(biaya);

            $('#preview-spd-tgl-surat').text(tglSurat);

            // Signatory Page 2 (PA remains Kepala Badan Keuangan Daerah)
            const kepalaSigner = signatories.find(s => s.jenis && s.jenis.toLowerCase() === 'kepala') || signer;
            $('#preview-spd-sign-nama').text(kepalaSigner.nama); // Pengguna Anggaran
            $('#preview-spd-sign-nama-2').text(kepalaSigner.nama); // Bottom signature
            $('#preview-spd-sign-nip-2').text(kepalaSigner.nip);

            // --- PAGE 3: VISUM ---
            $('#preview-visum-berangkat').text(berangkat);
            $('#preview-visum-tujuan').html(tempat);
            $('#preview-visum-tgl-berangkat').text(tglBerangkat);
            $('#preview-visum-tgl-kembali').text(tglKembali);

            // Signatory Page 3
            $('#preview-visum-sign-nama').text(kepalaSigner.nama);
            $('#preview-visum-sign-nip').text(kepalaSigner.nip);

            // PPTK Page 3
            $('#preview-visum-pptk-nama').text(pptk.nama);
            $('#preview-visum-pptk-nip').text(pptk.nip);
            $('#preview-visum-pptk-jabatan').text(pptk.jabatan);
            $('#preview-visum-pptk-bidang').text(pptk.bidang);


            // Update Pegawai Lists (Both Page 1 & 2)
            updatePegawaiList();
        }

        function updatePegawaiList() {
            // --- PAGE 1 LIST ---
            const listContainer1 = $('#preview-pegawai-list');
            listContainer1.empty();

            // --- PAGE 2 MAIN PEGAWAI (Row 2 & 3) ---
            const spdNama = $('#preview-spd-pegawai-nama');
            const spdNip = $('#preview-spd-pegawai-nip');
            const spdPangkat = $('#preview-spd-pegawai-pangkat');
            const spdJabatan = $('#preview-spd-pegawai-jabatan');

            // --- PAGE 2 PENGIKUT LIST (Row 8) ---
            const listContainer2 = $('#preview-spd-pengikut-list');
            listContainer2.empty();

            let index = 1;
            let firstPegawaiFound = false;

            $('.select2-pegawai').each(function () {
                const val = $(this).val();
                if (val) {
                    const selectedOption = $(this).find('option:selected');
                    const nama = selectedOption.data('nama') || '';
                    const nip = selectedOption.data('nip') || '';
                    const pangkat = selectedOption.data('pangkat') || '';
                    const jabatan = selectedOption.data('jabatan') || '';

                    // 1. POPULATE PAGE 1 LIST
                    const itemHtml1 = `
                    <div style="display: flex; margin-bottom: 15px;">
                        <div style="width: 20px; flex-shrink: 0;">${index}.</div>
                        <div style="flex: 1;">
                            <div style="display: flex;">
                                <div style="width: 100px;">Nama</div>
                                <div style="width: 15px; text-align: center;">:</div>
                                <div style="flex: 1;">${nama}</div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 100px;">Pangkat / Gol</div>
                                <div style="width: 15px; text-align: center;">:</div>
                                <div style="flex: 1;">${pangkat}</div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 100px;">NIP</div>
                                <div style="width: 15px; text-align: center;">:</div>
                                <div style="flex: 1;">${nip}</div>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 100px;">Jabatan</div>
                                <div style="width: 15px; text-align: center;">:</div>
                                <div style="flex: 1; text-align: left;">${jabatan}</div>
                            </div>
                        </div>
                    </div>`;
                    listContainer1.append(itemHtml1);

                    // 2. POPULATE PAGE 2 (SPD)
                    if (!firstPegawaiFound) {
                        // First Pegawai -> Main SPD Rows
                        spdNama.text(nama);
                        spdNip.text(nip);
                        spdPangkat.text(pangkat);
                        spdJabatan.text(jabatan);
                        firstPegawaiFound = true;
                    } else {
                        // Subsequent Pegawais -> Pengikut List
                        const pengikutIndex = index - 1;

                        const itemHtml2 = `
                        <table style="width: 100%; border: none; margin-bottom: 2px;">
                            <tr>
                                <td style="width: 20px; border: none; vertical-align: top; padding: 0;">${pengikutIndex}.</td>
                                <td style="border: none; vertical-align: top; padding: 0;">${nama}</td>
                            </tr>
                        </table>`;
                        listContainer2.append(itemHtml2);
                    }

                    index++;
                }
            });

            if (!firstPegawaiFound) {
                // Clear SPD if no pegawai
                spdNama.text('...');
                spdNip.text('...');
                spdPangkat.text('...');
                spdJabatan.text('...');
            }
        }

        function nl2br(str) {
            if (typeof str === 'undefined' || str === null) {
                return '';
            }
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1<br>$2');
        }

        function formatDateIndo(dateString) {
            if (!dateString) return '...';
            const date = new Date(dateString);
            if (isNaN(date.getTime())) return dateString;

            const months = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            const day = date.getDate();
            const month = months[date.getMonth()];
            const year = date.getFullYear();

            return `${day} ${month} ${year}`;
        }

        function addPegawai(selectedId = null) {
            // Check if Pegawai Utama is selected
            const pegawaiUtama = $('select[name="pegawai_utama"]').val();
            if (!pegawaiUtama) {
                alert('Mohon pilih Pegawai Utama terlebih dahulu.');
                return;
            }

            const wrapper = $('#pegawai-wrapper');

            // 1. Get the original select HTML from the first row as a string/template
            const firstRowSelect = wrapper.find('.pegawai-row').first().find('select');

            // 2. Create a clean variable of that select's outerHTML
            const tempSelect = firstRowSelect.clone();

            // Clean specific Select2 attributes and classes
            tempSelect.removeClass('select2-hidden-accessible');
            tempSelect.removeAttr('data-select2-id tabindex aria-hidden');
            tempSelect.find('option').removeAttr('data-select2-id');
            tempSelect.find('option').removeAttr('selected'); // Fix: Remove pre-selected attribute from clone
            tempSelect.val(''); // clear value

            // 3. Create the new Row container
            const newRow = $('<div class="pegawai-row" style="margin-bottom: 10px; display: flex; gap: 10px;"></div>');

            // 4. Create new Select element from cleaned HTML
            const cleanSelectHTML = tempSelect.prop('outerHTML');
            const newSelect = $(cleanSelectHTML);

            // Ensure style flex 1 and display block
            newSelect.css({
                'display': 'block',
                'flex': '1'
            });
            newSelect.attr('name', 'pengikut[]');
            newSelect.prop('required', false);
            newSelect.find('option:first').text('-- Pilih Pengikut --');

            if (selectedId) {
                newSelect.val(selectedId);
            }

            newRow.append(newSelect);

            // 5. Create and Append Remove Button
            const removeBtn = $('<button type="button" class="btn btn-remove">X</button>');
            removeBtn.css({
                'background-color': '#ef4444',
                'width': '50px',
                'padding': '0',
                'margin-left': '0',
                'flex-shrink': '0',
                'display': 'flex',
                'align-items': 'center',
                'justify-content': 'center'
            });

            removeBtn.on('click', function () {
                $(this).closest('.pegawai-row').remove();
                updatePreview();
                checkScheduleConflict();
            });

            newRow.append(removeBtn);

            // 6. Append to Wrapper
            wrapper.append(newRow);

            // 7. Initialize Select2 on the NEW element
            newSelect.select2({
                placeholder: "-- Pilih Pengikut --",
                width: '100%'
            }).on('change', function () {
                updatePreview();
                checkScheduleConflict();
            });
        }

        function calculateReturnDate() {
            const durationInput = document.getElementById('lama_perjalanan').value;
            const startDateInput = document.getElementById('tgl_berangkat').value;
            const returnDateInput = document.getElementById('tgl_kembali');

            // 1. Parse Duration
            const duration = parseInt(durationInput);

            if (isNaN(duration) || duration < 1) {
                return;
            }

            // 2. Parse Start Date (YYYY-MM-DD)
            if (!startDateInput) return;

            const startDate = new Date(startDateInput);

            // 3. Calculate Return Date
            const returnDate = new Date(startDate);
            returnDate.setDate(startDate.getDate() + (duration - 1));

            // 4. Format Output to YYYY-MM-DD
            const rYear = returnDate.getFullYear();
            const rMonth = String(returnDate.getMonth() + 1).padStart(2, '0');
            const rDay = String(returnDate.getDate()).padStart(2, '0');

            returnDateInput.value = `${rYear}-${rMonth}-${rDay}`;
            updatePreview();
            checkScheduleConflict();
        }

        function updateDay() {
            const dateInput = document.getElementById('tanggal_kegiatan');
            const dayInput = document.getElementById('hari');

            if (!dateInput.value) return;

            const date = new Date(dateInput.value);
            if (isNaN(date.getTime())) return;

            // Get Day Name in Indonesian
            const options = { weekday: 'long' };
            const dayName = date.toLocaleDateString('id-ID', options);

            dayInput.value = dayName;
            updatePreview();
        }

        function terbilang(angka) {
            const bil = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
            let res = "";
            if (angka < 12) {
                res = " " + bil[angka];
            } else if (angka < 20) {
                res = terbilang(angka - 10) + " belas";
            } else if (angka < 100) {
                res = terbilang(Math.floor(angka / 10)) + " puluh" + terbilang(angka % 10);
            } else if (angka < 200) {
                res = " seratus" + terbilang(angka - 100);
            } else if (angka < 1000) {
                res = terbilang(Math.floor(angka / 100)) + " ratus" + terbilang(angka % 100);
            }
            return res;
        }

        let conflictCheckTimeout = null;
        var hasActiveConflict = false;
        var currentConflicts = [];

        function showToast(message, type = 'error') {
            let container = $('#toast-container');
            if (container.length === 0) {
                container = $('<div id="toast-container" style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; display: flex; flex-direction: column; gap: 10px; pointer-events: none; align-items: center;"></div>');
                $('body').append(container);
            }

            const toastId = 'toast-' + Date.now();
            const bgColor = type === 'error' ? '#fef2f2' : '#f0fdf4';
            const borderColor = type === 'error' ? '#fecaca' : '#bbf7d0';
            const textColor = type === 'error' ? '#991b1b' : '#166534';
            const title = type === 'error' ? 'Jadwal Bentrok!' : 'Sukses';
            const icon = type === 'error'
                ? `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>`
                : `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>`;

            const toastHtml = `
                <div id="${toastId}" style="
                    pointer-events: auto;
                    background-color: ${bgColor};
                    border: 1px solid ${borderColor};
                    color: ${textColor};
                    padding: 1rem;
                    border-radius: 12px;
                    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                    display: flex;
                    align-items: start;
                    gap: 12px;
                    min-width: 320px;
                    max-width: 450px;
                    opacity: 0;
                    transform: translateY(-30px);
                    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.35s ease;
                ">
                    ${icon}
                    <div style="flex: 1; font-family: 'Instrument Sans', sans-serif;">
                        <div style="font-weight: 700; font-size: 0.9rem; margin-bottom: 2px;">${title}</div>
                        <div style="font-size: 0.8rem; line-height: 1.4; font-weight: 500;">${message}</div>
                    </div>
                    <button type="button" onclick="$('#${toastId}').css({ 'transform': 'translateY(-30px)', 'opacity': 0 }).delay(350).queue(function() { $(this).remove(); })" style="
                        background: none;
                        border: none;
                        cursor: pointer;
                        padding: 0;
                        color: inherit;
                        font-weight: bold;
                        font-size: 1.25rem;
                        line-height: 1;
                        flex-shrink: 0;
                        margin-left: 5px;
                        opacity: 0.6;
                    ">&times;</button>
                </div>
            `;

            container.append(toastHtml);

            // Animate in
            setTimeout(() => {
                $(`#${toastId}`).css({
                    'transform': 'translateY(0)',
                    'opacity': 1
                });
            }, 50);

            // Auto-dismiss after 7 seconds
            setTimeout(() => {
                const el = $(`#${toastId}`);
                if (el.length > 0) {
                    el.css({
                        'transform': 'translateY(-30px)',
                        'opacity': 0
                    });
                    setTimeout(() => { el.remove(); }, 350);
                }
            }, 7000);
        }

        function checkScheduleConflict() {
            clearTimeout(conflictCheckTimeout);
            conflictCheckTimeout = setTimeout(() => {
                const tglBerangkat = $('#tgl_berangkat').val();
                const tglKembali = $('#tgl_kembali').val();
                const pegawaiUtama = $('select[name="pegawai_utama"]').val();
                const excludeSpdId = $('input[name="id"]').val() || '';

                // Get all pengikut values
                const pengikutIds = [];
                $('select[name="pengikut[]"]').each(function() {
                    const val = $(this).val();
                    if (val) {
                        pengikutIds.push(val);
                    }
                });

                // Combine all pegawai ids
                const pegawaiIds = [];
                if (pegawaiUtama) {
                    pegawaiIds.push(pegawaiUtama);
                }
                pengikutIds.forEach(id => {
                    if (!pegawaiIds.includes(id)) {
                        pegawaiIds.push(id);
                    }
                });

                // Hide warning initially
                $('#conflict-warning-container').hide().empty();

                // Only check if we have dates and at least one employee
                if (!tglBerangkat || !tglKembali || pegawaiIds.length === 0) {
                    hasActiveConflict = false;
                    currentConflicts = [];
                    return;
                }

                $.ajax({
                    url: "{{ route('spd.check_availability') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        tgl_berangkat: tglBerangkat,
                        tgl_kembali: tglKembali,
                        pegawai_ids: pegawaiIds,
                        exclude_spd_id: excludeSpdId
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.has_conflict && response.conflicts.length > 0) {
                            // Detect changes in conflict lists
                            const newIds = response.conflicts.map(c => c.pegawai_id).sort().join(',');
                            const oldIds = currentConflicts.map(c => c.pegawai_id).sort().join(',');

                            currentConflicts = response.conflicts;
                            hasActiveConflict = true;

                            if (newIds !== oldIds) {
                                // Show a toast for each conflicting employee
                                currentConflicts.forEach(c => {
                                    const start = formatDateIndo(c.tgl_berangkat);
                                    const end = formatDateIndo(c.tgl_kembali);
                                    showToast(`Pegawai <strong>${c.pegawai_nama}</strong> sedang melakukan perjalanan dinas ke <strong>${c.tempat || '-'}</strong> pada ${start} s/d ${end}.`, 'error');
                                });
                            }



                            // Build warning list
                            let listHtml = '<ul style="margin: 5px 0 0 20px; list-style-type: disc; font-size: 0.875rem; color: #b91c1c;">';
                            response.conflicts.forEach(c => {
                                const start = formatDateIndo(c.tgl_berangkat);
                                const end = formatDateIndo(c.tgl_kembali);
                                listHtml += `<li style="margin-bottom: 4px;">Pegawai <strong>${c.pegawai_nama}</strong> sedang melakukan perjalanan dinas ke <strong>${c.tempat || '-'}</strong> pada <strong>${start} s/d ${end}</strong> (${c.maksud || '-'})</li>`;
                            });
                            listHtml += '</ul>';

                            // Display alert
                            const alertHtml = `
                                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl shadow-sm" role="alert">
                                    <div class="flex items-start gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-0.5 flex-shrink-0 text-red-600" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                        </svg>
                                        <div style="flex: 1;">
                                            <span class="text-sm font-bold text-red-800">Peringatan Bentrok Jadwal Pegawai:</span>
                                            <div class="mt-1">${listHtml}</div>
                                            <span class="text-xs text-red-600 font-semibold block mt-2">* Catatan: Anda tetap dapat memfinalisasi SPD ini meskipun terdapat jadwal bentrok.</span>
                                        </div>
                                    </div>
                                </div>
                            `;
                            $('#conflict-warning-container').html(alertHtml).show();
                        } else {
                            hasActiveConflict = false;
                            currentConflicts = [];
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Gagal memeriksa jadwal pegawai: ", error);
                    }
                });
            }, 300);
        }

        // Initialize Form
        initSpdForm();
    </script>
</body>

</html>