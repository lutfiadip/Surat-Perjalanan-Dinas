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
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            border-bottom: 2px solid var(--gray-100);
            padding-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--gray-700);
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--gray-200);
            border-radius: 0.375rem;
            font-size: 1rem;
            box-sizing: border-box;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: 2px solid var(--primary);
            border-color: var(--primary);
        }

        .btn {
            background-color: var(--primary);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.375rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .multi-select-note {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }

        /* Select2 Customization */
        .select2-container .select2-selection--single {
            height: 45px !important;
            padding: 8px 10px;
            border: 1px solid var(--gray-200);
            border-radius: 0.375rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 43px !important;
            right: 10px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px !important;
            padding-left: 0;
            color: var(--gray-900);
        }

        .select2-container {
            flex: 1;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Buat Surat Tugas & SPD</h1>

        <form id="spdForm" action="{{ route('spd.print') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Pilih Pegawai</label>
                <div id="pegawai-wrapper">
                    <div class="pegawai-row" style="margin-bottom: 10px; display: flex; gap: 10px;">
                        <select name="pegawai_ids[]" required style="flex: 1;" class="select2-pegawai">
                            <option value="">-- Pilih Pegawai Utama --</option>
                            @foreach($pegawais as $pegawai)
                                <option value="{{ $pegawai->id }}">
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
                    <input type="date" id="tgl_kembali" name="tgl_kembali" value="{{ now()->format('Y-m-d') }}" required
                        readonly style="background-color: var(--gray-200); cursor: not-allowed;">
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

    <script>
        $(document).ready(function () {
            // Initialize Select2 on existing selects
            $('.select2-pegawai').select2({
                placeholder: "-- Pilih Pegawai Utama --",
                width: '100%'
            });
        });

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
            });

            newRow.append(removeBtn);

            // 6. Append to Wrapper
            wrapper.append(newRow);

            // 7. Initialize Select2 on the NEW element
            newSelect.select2({
                placeholder: "-- Pilih Pengikut --",
                width: '100%'
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
        }

        // Initialize Day on Load
        window.addEventListener('DOMContentLoaded', (event) => {
            updateDay();
        });
    </script>
</body>

</html>