<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input SPD</title>
    <!-- jQuery & Select2 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        :root {
            --primary: #2563eb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-700: #374151;
            --gray-900: #111827;
        }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--gray-100);
            color: var(--gray-900);
            line-height: 1.5;
            padding: 2rem;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            display: grid;
            grid-template-columns: 1fr 550px;
            /* Force 550px */
            gap: 2rem;
        }

        .form-section {
            /* Left side */
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--gray-700);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid var(--gray-200);
            border-radius: 0.375rem;
            font-size: 1rem;
            box-sizing: border-box; /* Important for padding */
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
            border-radius: 0.375rem;
            font-weight: 500;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 1rem;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .preview-section {
            background: #525659;
            padding: 15px;
            border-radius: 8px;
            height: calc(100vh - 40px);
            overflow-y: auto;
            position: sticky;
            top: 20px;
        }

        .paper {
            background: white;
            width: 210mm;
            min-height: 297mm;
            padding: 10mm 15mm;
            margin: 0 auto 20px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            line-height: normal;
            color: #000;
            box-sizing: border-box;
            display: block;
            zoom: 0.65;
            /* Force 0.65 */
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

            /* Lowered breakpoint to 768px for mobile only */
            .container {
                grid-template-columns: 1fr;
            }

            .preview-section {
                display: block;
                position: static;
                height: auto;
                max-height: 800px;
            }

            .paper {
                transform: scale(0.9);
                margin-bottom: -30mm;
                zoom: 1;
                /* Reset zoom on mobile if needed, or keep it */
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- LEFT COLUMN: INPUT FORM -->
        <div class="form-section">
            <h1>Buat Surat Tugas & SPD</h1>

            <form id="spdForm" action="{{ route('spd.print') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Pilih Pegawai</label>
                    <div id="pegawai-wrapper">
                        <div class="pegawai-row" style="margin-bottom: 10px; display: flex; gap: 10px;">
                            <select name="pegawai_ids[]" required style="flex: 1;" class="select2-pegawai"
                                onchange="updatePreview()">
                                <option value="">-- Pilih Pegawai Utama --</option>
                                @foreach($pegawais as $pegawai)
                                    <option value="{{ $pegawai->id }}" data-nama="{{ $pegawai->nama }}"
                                        data-nip="{{ $pegawai->nip }}" data-pangkat="{{ $pegawai->pangkat_gol }}"
                                        data-jabatan="{{ $pegawai->jabatan }}">
                                        {{ $pegawai->nama }} ({{ $pegawai->nip }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="button" id="btn-add-pegawai" onclick="addPegawai()" class="btn"
                        style="background-color: #10b981; width: auto; padding: 0.5rem 1rem; font-size: 0.9rem;">
                        + Tambah Pengikut
                    </button>
                    <p class="multi-select-note" style="margin-top: 10px;">Pegawai pertama adalah Pegawai Utama,
                        selanjutnya adalah Pengikut.</p>
                </div>

                <div class="grid" style="grid-template-columns: 1fr 1fr 1fr;">
                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input type="text" name="nomor_surat" placeholder="contoh: 094 / 123 / XII / 2025" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Surat</label>
                        <input type="date" name="tanggal_surat" value="{{ now()->format('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun Anggaran</label>
                        <input type="number" name="tahun_anggaran" value="{{ date('Y') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Dasar Surat (Untuk Konsiderans "Berdasarkan")</label>
                    <textarea name="dasar_surat" rows="2"
                        placeholder="Contoh: Surat dari Badan Pengelola... Nomor: ... perihal ...">Surat dari Badan Pengelola Pendapatan Daerah Provinsi Jawa Tengah Nomor: 100.2.2.3/599/BAPENDA/2025 perihal Rekonsiliasi Opsen Pajak Daerah.</textarea>
                </div>

                <div class="form-group">
                    <label>Untuk (Maksud Perjalanan Dinas)</label>
                    <textarea name="maksud" rows="2" required
                        placeholder="Contoh: Menghadiri Rekonsiliasi Opsen Pajak Daerah">Menghadiri Rekonsiliasi Opsen Pajak Daerah</textarea>
                </div>

                <div class="grid">
                    <div class="form-group">
                        <label>Hari</label>
                        <input type="text" id="hari" name="hari" value="{{ now()->locale('id')->isoFormat('dddd') }}"
                            required readonly style="background-color: var(--gray-200);">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Kegiatan</label>
                        <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan"
                            value="{{ now()->format('Y-m-d') }}" required oninput="updateDay()">
                    </div>
                </div>

                <div class="form-group">
                    <label>Tempat Kegiatan</label>
                    <textarea name="tempat" rows="2" required>Bank Jateng KCU Surakarta.
Jl. Slamet Riyadi No 20 Surakarta</textarea>
                </div>

                <hr style="margin: 2rem 0; border: 0; border-top: 2px solid var(--gray-200);">
                <h3>Detail SPD</h3>

                <div class="form-group">
                    <label>Tingkat Biaya Perjalanan Dinas</label>
                    <input type="text" name="tingkat_biaya" placeholder="Kosongkan jika tidak ada">
                </div>

                <div class="grid">
                    <div class="form-group">
                        <label>Alat Angkut</label>
                        <input type="text" name="alat_angkut" value="Kendaraan Dinas" required>
                    </div>
                    <div class="form-group">
                        <label>Lama Perjalanan (Hari)</label>
                        <input type="number" id="lama_perjalanan" name="lama_perjalanan" value="1" min="1" required
                            oninput="calculateReturnDate()">
                    </div>
                </div>

                <div class="form-group">
                    <label>Tempat Berangkat</label>
                    <input type="text" name="tempat_berangkat" value="BKD Karanganyar" required>
                </div>

                <div class="grid">
                    <div class="form-group">
                        <label>Tanggal Berangkat</label>
                        <input type="date" id="tgl_berangkat" name="tgl_berangkat" value="{{ now()->format('Y-m-d') }}"
                            required oninput="calculateReturnDate()">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Harus Kembali</label>
                        <input type="date" id="tgl_kembali" name="tgl_kembali" value="{{ now()->format('Y-m-d') }}"
                            required readonly style="background-color: var(--gray-200); cursor: not-allowed;">
                    </div>
                </div>

                <div class="grid">
                    <div class="form-group">
                        <label>Pembebanan Anggaran (SKPD)</label>
                        <input type="text" name="anggaran_skpd" value="Badan Keuangan Daerah" required>
                    </div>
                    <div class="form-group">
                        <label>Kode Rekening</label>
                        <input type="text" name="kode_rekening" placeholder="Kosongkan jika tidak ada">
                    </div>
                </div>

                <div class="form-group">
                    <label>Keterangan Lain-Lain</label>
                    <textarea name="keterangan_lain" rows="2" placeholder="Kosongkan jika tidak ada"></textarea>
                </div>

                <div class="form-group">
                    <label>Penandatangan Surat</label>
                    <select name="penandatangan" class="form-control"
                        style="width: 100%; padding: 0.75rem; border: 1px solid var(--gray-200); border-radius: 0.375rem;">
                        <option value="kepala">Kepala Badan Keuangan Daerah</option>
                        <option value="sekretaris">Sekretaris (a.n. Kepala Badan Keuangan Daerah)</option>
                    </select>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" formaction="{{ route('spd.print') }}" class="btn">Cetak Surat</button>
                    <button type="submit" formaction="{{ route('spd.export_word') }}" class="btn"
                        style="background-color: #059669;">Export Word</button>
                </div>
            </form>
        </div>

        <!-- End .form-section -->

        <!-- RIGHT COLUMN: PREVIEW -->
        <div class="preview-section">
            <h3 style="color: white; margin-top: 0; margin-bottom: 20px; text-align: center;">Live Preview (Halaman 1)
            </h3>

            <div class="paper">
                <!-- KOP SURAT PREVIEW -->
                <div
                    style="display: flex; align-items: center; border-bottom: 4px double #000; padding-bottom: 5px; margin-bottom: 10px;">
                    <img src="{{ asset('img/logo.png') }}" style="width: 70px; height: auto; margin-right: 15px;">
                    <div style="text-align: center; flex: 1;">
                        <h3 style="font-size: 12pt; margin: 0; font-weight: normal;">PEMERINTAH KABUPATEN KARANGANYAR
                        </h3>
                        <h2 style="font-size: 16pt; margin: 0; font-weight: bold;">BADAN KEUANGAN DAERAH</h2>
                        <p style="font-size: 9pt; margin: 2px 0;">Jalan KH.Wachid Hasyim Nomor .2 Karanganyar, Provinsi
                            Jawa Tengah</p>
                        <p style="font-size: 9pt; margin: 2px 0;">Kode Pos 57713 Telp.(0271) 495066 , 495138 Fax. (0271)
                            6491366</p>
                        <p style="font-size: 9pt; margin: 2px 0;">Laman : www.bkd.karanganyar.go.id Pos-el :
                            bkd@karanganyarkab.go.id</p>
                    </div>
                </div>

                <div style="padding-left: 30px;">
                    <div
                        style="text-align: center; font-weight: bold; font-size: 12pt; margin-bottom: 5px; letter-spacing: 1px;">
                        SURAT TUGAS</div>
                    <div style="display: flex; margin-bottom: 15px; font-weight: bold;">
                        <div style="width: 40%; text-align: right; padding-right: 5px;">Nomor :</div>
                        <div style="flex: 1; text-align: left; padding-left: 5px;"><span id="preview-nomor">...</span>
                        </div>
                    </div>

                    <div style="text-align: center; font-weight: normal; margin-bottom: 0px;">Kepala Badan Keuangan
                        Daerah</div>

                    <!-- BERDASARKAN -->
                    <div style="display: flex; margin-bottom: 8px;">
                        <div style="width: 100px; flex-shrink: 0;">Berdasarkan</div>
                        <div style="width: 20px; text-align: center; font-weight: bold;">:</div>
                        <div style="flex: 1; text-align: justify; text-align-last: justify;">
                            <span id="preview-dasar">...</span>
                        </div>
                    </div>

                    <div style="text-align: center; margin: 10px 0;">memberikan perintah</div>

                    <!-- KEPADA -->
                    <div style="display: flex; margin-bottom: 8px;">
                        <div style="width: 60px; flex-shrink: 0;">Kepada</div>
                        <div style="width: 20px; text-align: center; font-weight: bold;">:</div>
                        <div style="flex: 1;" id="preview-pegawai-list">
                            <!-- JS WILL POPULATE THIS -->
                            <div style="font-style: italic; color: #999;">(Pilih pegawai untuk menampilkan)</div>
                        </div>
                    </div>

                    <!-- UNTUK -->
                    <div style="display: flex; margin-bottom: 8px;">
                        <div style="width: 60px; flex-shrink: 0;">Untuk</div>
                        <div style="width: 20px; text-align: center; font-weight: bold;">:</div>
                        <div style="flex: 1;">
                            <div style="display: flex; margin-bottom: 5px; align-items: flex-start;">
                                <div style="width: 20px; flex-shrink: 0;">1.</div>
                                <div style="flex: 1; text-align: justify;">
                                    <span id="preview-maksud">...</span>, yang diselenggarakan pada:<br>
                                    <div style="margin-top: 5px; display: flex;">
                                        <div style="width: 100px;">Hari</div>
                                        <div style="width: 15px; text-align: center;">:</div>
                                        <div style="flex: 1;"><span id="preview-hari">...</span></div>
                                    </div>
                                    <div style="display: flex;">
                                        <div style="width: 100px;">Tanggal</div>
                                        <div style="width: 15px; text-align: center;">:</div>
                                        <div style="flex: 1;"><span id="preview-tgl-kegiatan">...</span></div>
                                    </div>
                                    <div style="display: flex;">
                                        <div style="width: 100px;">Tempat</div>
                                        <div style="width: 15px; text-align: center;">:</div>
                                        <div style="flex: 1;"><span id="preview-tempat">...</span></div>
                                    </div>
                                </div>
                            </div>
                            <div style="height: 15px;"></div>
                            <div style="display: flex; margin-bottom: 5px; align-items: flex-start;">
                                <div style="width: 20px; flex-shrink: 0;">2.</div>
                                <div style="flex: 1; text-align: justify;">Melaporkan hasil tugas kepada pejabat yang
                                    bersangkutan.</div>
                            </div>
                            <div style="display: flex; margin-bottom: 5px; align-items: flex-start;">
                                <div style="width: 20px; flex-shrink: 0;">3.</div>
                                <div style="flex: 1; text-align: justify;">Dengan diterbitkannya Surat Perintah Tugas
                                    ini, maka segala biaya yang timbul dibebankan pada APBD Kabupaten Karanganyar Tahun
                                    Anggaran <span id="preview-tahun">...</span>.</div>
                            </div>
                        </div>
                    </div>

                    <!-- SIGNATURE -->
                    <div style="float: right; width: 300px; margin-top: 15px; text-align: left;">
                        <div style="margin-bottom: 20mm;">
                            Di keluarkan di Karanganyar<br>
                            Tanggal <span id="preview-tgl-surat">...</span><br>
                            <span id="preview-sign-role">Pengguna Anggaran / Kuasa Pengguna Anggaran,</span>
                        </div>
                        <div>(<span id="preview-sign-nama">...</span>)</div>
                        <div>NIP. <span id="preview-sign-nip">...</span></div>
                    </div>

                </div>
            </div> <!-- End Page 1 Paper -->

            <h3 style="color: white; margin-top: 20px; margin-bottom: 20px; text-align: center;">Live Preview (Halaman 2
                - SPD)</h3>

            <div class="paper">
                <div
                    style="display: flex; align-items: center; border-bottom: 4px double #000; padding-bottom: 5px; margin-bottom: 10px;">
                    <img src="{{ asset('img/logo.png') }}" style="width: 70px; height: auto; margin-right: 15px;">
                    <div style="text-align: center; flex: 1;">
                        <h3 style="font-size: 12pt; margin: 0; font-weight: normal;">PEMERINTAH KABUPATEN KARANGANYAR
                        </h3>
                        <h2 style="font-size: 16pt; margin: 0; font-weight: bold;">BADAN KEUANGAN DAERAH</h2>
                        <p style="font-size: 9pt; margin: 2px 0;">Jalan KH.Wachid Hasyim Nomor .2 Karanganyar, Provinsi
                            Jawa Tengah</p>
                        <p style="font-size: 9pt; margin: 2px 0;">Kode Pos 57713 Telp.(0271) 495066 , 495138 Fax. (0271)
                            6491366</p>
                        <p style="font-size: 9pt; margin: 2px 0;">Laman : www.bkd.karanganyar.go.id Pos-el :
                            bkd@karanganyarkab.go.id</p>
                    </div>
                </div>

                <div style="float: right; width: 50%; margin-bottom: 10px; font-size: 10pt;">
                    <table style="width: 100%; border: none;">
                        <tr>
                            <td style="width: 60px;">Lembar ke</td>
                            <td>: ............................................................</td>
                        </tr>
                        <tr>
                            <td>Kode No</td>
                            <td>: ............................................................</td>
                        </tr>
                        <tr>
                            <td>Nomor</td>
                            <td>: ............................................................</td>
                        </tr>
                    </table>
                </div>
                <div style="clear: both;"></div>

                <div
                    style="text-align: center; font-weight: normal; text-decoration: underline; font-size: 11pt; margin-bottom: 8px;">
                    SURAT PERJALANAN DINAS (SPD)</div>

                <table class="spd-table"
                    style="table-layout: fixed; width: 100%; border-collapse: collapse; border: 1px solid black;">
                    <colgroup>
                        <col style="width: 5%;">
                        <col style="width: 35%;">
                        <col style="width: 60%;">
                    </colgroup>
                    <tr>
                        <td style="text-align: center; border: 1px solid black; padding: 5px;">1</td>
                        <td style="border: 1px solid black; padding: 5px;">Pengguna Anggaran / Kuasa Pengguna Anggaran
                        </td>
                        <td style="border: 1px solid black; padding: 5px;">
                            <span id="preview-spd-sign-nama">...</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; border: 1px solid black; padding: 5px;">2</td>
                        <td style="border: 1px solid black; padding: 5px;">Nama /NIP Pegawai yang Melaksanakan
                            Perjalanan Dinas</td>
                        <td style="border: 1px solid black; padding: 5px;">
                            <span id="preview-spd-pegawai-nama">...</span><br>
                            <span id="preview-spd-pegawai-nip">...</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; border: 1px solid black; padding: 5px;">3</td>
                        <td style="border: 1px solid black; padding: 5px;">
                            a. Pangkat dan Golongan<br>
                            b. Jabatan / Instansi<br>
                            c. Tingkat Biaya Perjalanan Dinas
                        </td>
                        <td style="border: 1px solid black; padding: 5px;">
                            a. <span id="preview-spd-pegawai-pangkat">...</span><br>
                            b. <span id="preview-spd-pegawai-jabatan">...</span><br>
                            c. <span id="preview-spd-biaya">...</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; border: 1px solid black; padding: 5px;">4</td>
                        <td style="border: 1px solid black; padding: 5px;">Maksud Perjalanan Dinas</td>
                        <td style="border: 1px solid black; padding: 5px;"><span id="preview-spd-maksud">...</span></td>
                    </tr>
                    <tr>
                        <td style="text-align: center; border: 1px solid black; padding: 5px;">5</td>
                        <td style="border: 1px solid black; padding: 5px;">Alat Angkut yang Digunakan</td>
                        <td style="border: 1px solid black; padding: 5px;"><span id="preview-spd-alat">...</span></td>
                    </tr>
                    <tr>
                        <td style="text-align: center; border: 1px solid black; padding: 5px;">6</td>
                        <td style="border: 1px solid black; padding: 5px;">
                            a. Tempat Berangkat<br>
                            b. Tempat Tujuan
                        </td>
                        <td style="border: 1px solid black; padding: 5px;">
                            a. <span id="preview-spd-berangkat">...</span><br>
                            b. <span id="preview-spd-tujuan">...</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; border: 1px solid black; padding: 5px;">7</td>
                        <td style="border: 1px solid black; padding: 5px;">
                            a. Lama Perjalanan Dinas<br>
                            b. Tanggal Berangkat<br>
                            c. Tanggal Harus Kembali
                        </td>
                        <td style="border: 1px solid black; padding: 5px;">
                            a. <span id="preview-spd-lama">...</span><br>
                            b. <span id="preview-spd-tgl-berangkat">...</span><br>
                            c. <span id="preview-spd-tgl-kembali">...</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; border: 1px solid black; padding: 5px;">8</td>
                        <td style="border: 1px solid black; padding: 5px;">Pengikut</td>
                        <td style="border: 1px solid black; padding: 5px;" id="preview-spd-pengikut-list">
                            <!-- Populated by JS -->
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; border: 1px solid black; padding: 5px;">9</td>
                        <td style="border: 1px solid black; padding: 5px;">
                            Pembebanan Anggaran<br>
                            a. SKPD<br>
                            b. Kode Rekening
                        </td>
                        <td style="border: 1px solid black; padding: 5px;">
                            a. <span id="preview-spd-skpd">...</span><br>
                            b. <span id="preview-spd-rekening">...</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; border: 1px solid black; padding: 5px;">10</td>
                        <td style="border: 1px solid black; padding: 5px;">Keterangan Lain - Lain</td>
                        <td style="border: 1px solid black; padding: 5px;"><span id="preview-spd-ket">...</span></td>
                    </tr>
                </table>

                <div style="margin-top: 30px; float: right; width: 300px;">
                    <div>Di keluarkan di Karanganyar</div>
                    <div style="margin-bottom: 20mm;">
                        Tanggal <span id="preview-spd-tgl-surat">...</span><br>
                        Pengguna Anggaran / Kuasa Pengguna Anggaran,
                    </div>
                    <div>(<span id="preview-spd-sign-nama-2">...</span>)</div>
                    <div>NIP. <span id="preview-spd-sign-nip-2">...</span></div>
                </div>
                <div style="clear: both;"></div>

            </div>

            <h3 style="color: white; margin-top: 20px; margin-bottom: 20px; text-align: center;">Live Preview (Halaman 3
                - Visum)</h3>

            <div class="paper">
                <table
                    style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif; font-size: 10pt; border: 1px solid black; table-layout: fixed;">
                    <colgroup>
                        <col style="width: 5%; border: 1px solid black;">
                        <col style="width: 37%; border: 1px solid black;">
                        <col style="width: 58%; border: 1px solid black;">
                    </colgroup>

                    <!-- ROW I -->
                    <tr style="height: 140px;">
                        <td colspan="2" style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black; vertical-align: top; padding: 5px;">
                            <table style="width: 100%; border: none; font-size: 10pt;">
                                <tr>
                                    <td style="width: 3%; vertical-align: top; white-space: nowrap; padding-left: 5px;">
                                        I.</td>
                                    <td
                                        style="width: 42%; vertical-align: top; white-space: nowrap; padding-left: 10px;">
                                        Berangkat dari</td>
                                    <td style="width: 2%; vertical-align: top;">:</td>
                                    <td style="width: 53%; vertical-align: top; white-space: nowrap;">
                                        <span id="preview-visum-berangkat">...</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="vertical-align: top; white-space: nowrap; padding-left: 10px;">(tempat
                                        kedudukan)
                                    </td>
                                    <td style="vertical-align: top;"></td>
                                    <td style="vertical-align: top;"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="vertical-align: top; padding-left: 10px;">Ke</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td style="vertical-align: top;"><span id="preview-visum-tujuan">...</span></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="vertical-align: top; padding-left: 10px;">Pada Tanggal</td>
                                    <td style="vertical-align: top;">:</td>
                                    <td style="vertical-align: top;"><span id="preview-visum-tgl-berangkat">...</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="3" style="padding-left: 10px; vertical-align: top;">
                                        <div style="margin-top: 10px;">Kepala Sub Bagian Umum,</div>
                                        <div>Selaku Pejabat Pelaksana Teknis Kegiatan</div>
                                        <div>Sekretariat</div>
                                        <br><br><br>
                                        <div>(NOVAN DEKA SETYA G, S.S.T.P., M.M)</div>
                                        <div>NIP. 19901113 201507 1 001</div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- ROWS II - V (Static Empty) -->
                    <tr>
                        <td rowspan="3"
                            style="border: 1px solid black; vertical-align: top; padding: 1px; text-align: center;">II
                        </td>
                        <td style="border: 1px solid black; padding: 2px;">Tiba :</td>
                        <td style="border: 1px solid black; padding: 2px;">Berangkat dari :</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; padding: 2px;">Pada tanggal :</td>
                        <td style="border: 1px solid black; padding: 2px;">Pada tanggal :</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; height: 60px;"></td>
                        <td style="border: 1px solid black; height: 60px;"></td>
                    </tr>

                    <!-- ROW VI -->
                    <tr>
                        <td rowspan="3" style="border: 1px solid black; vertical-align: top; padding-left: 5px;">VI</td>
                        <td style="border: 1px solid black; vertical-align: top; padding: 2px;">Tiba : di Karanganyar
                        </td>
                        <td rowspan="3"
                            style="border: 1px solid black; vertical-align: top; padding: 5px; text-align: justify;">
                            SPD telah diperiksa dengan keterangan bahwa perjalanan tersebut di atas benar dilakukan atas
                            perintah sesuai dengan kepentingan jabatan dan dilaksanakan dalam waktu yang
                            sesingkat-singkatnya.
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; vertical-align: top; padding: 2px;">
                            Pada tanggal : <span id="preview-visum-tgl-kembali">...</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid black; vertical-align: top; padding: 2px; height: 100px;">
                            <div
                                style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                                <div>Kepala Badan Keuangan Daerah</div>
                                <div>
                                    <div>(<span id="preview-visum-sign-nama">...</span>)</div>
                                    <div>NIP. <span id="preview-visum-sign-nip">...</span></div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- ROW VII -->
                    <tr>
                        <td style="border: 1px solid black; vertical-align: top; padding-left: 5px;">VII</td>
                        <td colspan="2" style="border: 1px solid black; vertical-align: top; padding: 2px 2px 2px 5px;">
                            Catatan Lain Lain
                        </td>
                    </tr>

                    <!-- ROW VIII -->
                    <tr>
                        <td style="border: 1px solid black; vertical-align: top; padding-left: 5px;">VIII</td>
                        <td colspan="2"
                            style="border: 1px solid black; vertical-align: top; padding: 2px 2px 2px 5px; text-align: justify;">
                            <div style="font-weight: bold;">PERHATIAN :</div>
                            Pengguna anggaran/kuasa pengguna anggaran yang menerbitkan SPD, pejabat/pegawai/pihak lain
                            yang
                            melakukan perjalanan dinas, pejabat yang mengesahkan tanggal berangkat/tiba, serta bendahara
                            pengeluaran bertanggung jawab berdasarkan peraturan-peraturan keuangan daerah apabila negara
                            menderita rugi akibat kesalahan, kelalaian, dan kealpaannya.
                        </td>
                    </tr>

                </table>
            </div>

        </div>
    </div> <!-- End .container -->

    <script>
        $(document).ready(function () {
            // Initialize Select2 on existing selects
            $('.select2-pegawai').select2({
                placeholder: "-- Pilih Pegawai Utama --",
                width: '100%'
            }).on('change', function () {
                updatePreview();
            });

            // Initial Preview Update
            updatePreview();

            // Bind Input Events
            $('input, textarea, select').on('input change', function () {
                updatePreview();
            });
        });

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

            const signRoleVal = $('[name="penandatangan"]').val();

            // --- PAGE 1: SURAT TUGAS ---
            $('#preview-nomor').text(nomor);
            $('#preview-dasar').html(dasar);
            $('#preview-maksud').html(maksud);
            $('#preview-hari').text(hari);
            $('#preview-tempat').html(tempat);
            $('#preview-tahun').text(tahun);

            $('#preview-tgl-kegiatan').text(tglKegiatan);
            $('#preview-tgl-surat').text(tglSurat);

            // Signatory Page 1
            if (signRoleVal === 'sekretaris') {
                $('#preview-sign-role').html('a.n. KEPALA BADAN KEUANGAN DAERAH<br>Sekretaris');
                $('#preview-sign-nama').text('.........................');
                $('#preview-sign-nip').text('.........................');
            } else {
                $('#preview-sign-role').html('Kepala Badan Keuangan Daerah<br><br>');
                $('#preview-sign-nama').text('.........................');
                $('#preview-sign-nip').text('.........................');
            }

            // --- PAGE 2: SPD ---
            $('#preview-spd-maksud').html(maksud);
            $('#preview-spd-alat').text(alat);
            $('#preview-spd-berangkat').text(berangkat);
            $('#preview-spd-tujuan').html(tempat);
            $('#preview-spd-lama').text(lama + ' hari');
            $('#preview-spd-tgl-berangkat').text(tglBerangkat);
            $('#preview-spd-tgl-kembali').text(tglKembali);
            $('#preview-spd-skpd').text(skpd);
            $('#preview-spd-rekening').text(rekening);
            $('#preview-spd-ket').html(ketLain);
            $('#preview-spd-biaya').text(biaya);

            $('#preview-spd-tgl-surat').text(tglSurat);

            // Signatory Page 2
            if (signRoleVal === 'sekretaris') {
                $('#preview-spd-sign-nama').text('.........................');
                $('#preview-spd-sign-nama-2').text('.........................');
                $('#preview-spd-sign-nip-2').text('.........................');
            } else {
                $('#preview-spd-sign-nama').text('.........................');
                $('#preview-spd-sign-nama-2').text('.........................');
                $('#preview-spd-sign-nip-2').text('.........................');
            }

            // --- PAGE 3: VISUM ---
            $('#preview-visum-berangkat').text(berangkat);
            $('#preview-visum-tujuan').html(tempat);
            $('#preview-visum-tgl-berangkat').text(tglBerangkat);
            $('#preview-visum-tgl-kembali').text(tglKembali);

            if (signRoleVal === 'sekretaris') {
                $('#preview-visum-sign-nama').text('.........................');
                $('#preview-visum-sign-nip').text('.........................');
            } else {
                $('#preview-visum-sign-nama').text('.........................');
                $('#preview-visum-sign-nip').text('.........................');
            }


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
                    <div style="display: flex; margin-bottom: 4px;">
                        <div style="width: 20px; flex-shrink: 0;">${index > 1 ? index + '.' : ''}</div>
                        <div style="flex: 1;">
                            <div style="display: flex;">
                                <div style="width: 100px;">Nama</div>
                                <div style="width: 15px; text-align: center;">:</div>
                                <div style="flex: 1; font-weight: bold;">${nama}</div>
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

        function addPegawai() {
            const wrapper = $('#pegawai-wrapper');

            // 1. Get the original select HTML from the first row as a string/template
            const firstRowSelect = wrapper.find('.pegawai-row').first().find('select');

            // 2. Create a clean variable of that select's outerHTML
            const tempSelect = firstRowSelect.clone();

            // Clean specific Select2 attributes and classes
            tempSelect.removeClass('select2-hidden-accessible');
            tempSelect.removeAttr('data-select2-id tabindex aria-hidden');
            tempSelect.find('option').removeAttr('data-select2-id');
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
            newSelect.prop('required', false);
            newSelect.find('option:first').text('-- Pilih Pengikut --');

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

        // Initialize Day on Load
        window.addEventListener('DOMContentLoaded', (event) => {
            updateDay();
        });
    </script>
</body>

</html>