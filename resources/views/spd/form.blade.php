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
            align-items: center; /* Horizontally center content */
            justify-content: center; /* Vertically center content */
        }

        .container {
            width: 100%;
            margin: auto; /* Allow flex to handle centering, but auto margins help with vertical if needed */
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
            grid-template-columns: 1fr 550px;
            max-width: 100%;
            /* Expand to full width */
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

        /* Hide preview by default */
        .preview-section {
            display: none;
        }

        /* Show preview when active */
        .container.with-preview .preview-section {
            display: block;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
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
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h1 style="margin: 0;">Buat SPD</h1>
                <button type="button" id="btn-toggle-preview" class="btn">
                    Lihat Preview
                </button>
            </div>

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
                        style="width: auto; padding: 0.5rem 1rem; font-size: 0.9rem;">
                        + Tambah Pengikut
                    </button>
                    <p class="multi-select-note" style="margin-top: 10px;">Pegawai pertama adalah Pegawai Utama,
                        selanjutnya adalah Pengikut.</p>
                </div>

                <div class="grid" style="grid-template-columns: 1fr 1fr 1fr;">
                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input type="text" name="nomor_surat" placeholder="contoh: 094 / 123 / XII / 2025">
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
                            required readonly style="background-color: var(--border-color);">
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

                <hr style="margin: 2rem 0; border: 0; border-top: 2px solid var(--border-color);">
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
                            required readonly style="background-color: var(--border-color); cursor: not-allowed;">
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
                        style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 0.375rem;">
                        <option value="kepala">Kepala Badan Keuangan Daerah</option>
                        <option value="sekretaris">Sekretaris (a.n. Kepala Badan Keuangan Daerah)</option>
                    </select>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" formaction="{{ route('spd.print') }}" class="btn">Cetak Surat</button>
                    <button type="submit" formaction="{{ route('spd.export_word') }}" class="btn">Export Word</button>
                </div>
            </form>
        </div>

        <!-- End .form-section -->

        <!-- RIGHT COLUMN: PREVIEW -->
        @include('spd.preview')

    </div> <!-- End .container -->

    <script>
        const signatories = @json($signatories);



        $(document).ready(function () {
            // Toggle Preview Handler
            $('#btn-toggle-preview').on('click', function () {
                const container = $('.container');
                const btn = $(this);

                container.toggleClass('with-preview');

                if (container.hasClass('with-preview')) {
                    btn.html('Tutup Preview');
                    btn.css('background-color', '#ef4444');
                } else {
                    btn.html('Lihat Preview');
                    btn.css('background-color', ''); // Reset to default class style
                }
            });

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
            const signer = signatories[signRoleVal] || signatories['kepala'];

            // --- PAGE 1: SURAT TUGAS ---
            $('#preview-nomor').text(nomor);
            // Process Dasar Surat with special justification for "Nomor:" splitting
            let dasarHtml = '<div style="text-align: justify; text-align-last: justify;">' +
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
            const signContainer = $('#preview-signature-container');
            let signHtml = '';

            if (signRoleVal === 'sekretaris') {
                // Table layout for hanging "a.n." and indented details, matching User Image
                // Note: User image shows Name in Title Case, Pangkat included.
                // Structure:
                // Row 1: Date (Indented/Col 2)
                // Row 2: a.n. (Col 1) | Kepala... Sekretaris (Col 2)
                // Row 3: Name, Pangkat, NIP (Col 2)

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
                            Sekretaris
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 60px; border: none;"></td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 0;"></td>
                        <td style="vertical-align: top; border: none; padding: 0;">
                            ${signer.nama_title}<br>
                            ${signer.pangkat}<br>
                            NIP. ${signer.nip}
                        </td>
                    </tr>
                </table>`;
            } else {
                // Standard Kepala Layout - Using Table for Alignment Consistency with Sekretaris
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
                        <td style="vertical-align: top; border: none; padding: 0;"></td>
                        <td style="vertical-align: top; border: none; padding: 0;">
                            Kepala Badan Keuangan Daerah
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="height: 60px; border: none;"></td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 0;"></td>
                        <td style="vertical-align: top; border: none; padding: 0;">
                            ${signer.nama_title}<br>
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

            // Signatory Page 2
            $('#preview-spd-sign-nama').text(signer.nama); // Pengguna Anggaran
            $('#preview-spd-sign-nama-2').text(signer.nama); // Bottom signature
            $('#preview-spd-sign-nip-2').text(signer.nip);

            // --- PAGE 3: VISUM ---
            $('#preview-visum-berangkat').text(berangkat);
            $('#preview-visum-tujuan').html(tempat);
            $('#preview-visum-tgl-berangkat').text(tglBerangkat);
            $('#preview-visum-tgl-kembali').text(tglKembali);

            // Signatory Page 3
            $('#preview-visum-sign-nama').text(signer.nama);
            $('#preview-visum-sign-nip').text(signer.nip);


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

        // Initialize Day on Load
        window.addEventListener('DOMContentLoaded', (event) => {
            updateDay();
        });
    </script>
</body>

</html>