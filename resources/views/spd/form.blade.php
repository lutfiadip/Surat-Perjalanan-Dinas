<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input SPD</title>
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
    </style>
</head>

<body>

    <div class="container">
        <h1>Buat Surat Tugas & SPD</h1>

        <form id="spdForm" action="{{ route('spd.print') }}" method="POST">
            @csrf

            <!-- PEGAWAI SELECTION -->
            <div class="form-group">
                <label>Pilih Pegawai</label>
                <div id="pegawai-wrapper">
                    <div class="pegawai-row" style="margin-bottom: 10px; display: flex; gap: 10px;">
                        <select name="pegawai_ids[]" required style="flex: 1;">
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
                <p class="multi-select-note" style="margin-top: 10px;">Pegawai pertama adalah Pegawai Utama/Ketua,
                    selanjutnya adalah Pengikut.</p>
            </div>

            <!-- NOMOR SURAT -->
            <div class="grid">
                <div class="form-group">
                    <label>Nomor Surat</label>
                    <input type="text" name="nomor_surat" placeholder="contoh: 094 / 123 / XII / 2025" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Surat</label>
                    <input type="date" name="tanggal_surat" value="{{ now()->format('Y-m-d') }}"
                        required>
                </div>
            </div>

            <!-- DASAR SURAT -->
            <div class="form-group">
                <label>Dasar Surat (Untuk Konsiderans "Berdasarkan")</label>
                <textarea name="dasar_surat" rows="2"
                    placeholder="Contoh: Surat dari Badan Pengelola... Nomor: ... perihal ...">Surat dari Badan Pengelola Pendapatan Daerah Provinsi Jawa Tengah Nomor: 100.2.2.3/599/BAPENDA/2025 perihal Rekonsiliasi Opsen Pajak Daerah.</textarea>
            </div>

            <!-- UNTUK / MAKSUD -->
            <div class="form-group">
                <label>Untuk (Maksud Perjalanan Dinas)</label>
                <textarea name="maksud" rows="2" required
                    placeholder="Contoh: Menghadiri Rekonsiliasi Opsen Pajak Daerah">Menghadiri Rekonsiliasi Opsen Pajak Daerah</textarea>
            </div>

            <!-- JADWAL DAN LOKASI -->
            <div class="grid">
                <div class="form-group">
                    <label>Hari</label>
                    <input type="text" id="hari" name="hari" value="{{ now()->locale('id')->isoFormat('dddd') }}" required readonly style="background-color: var(--gray-200);">
                </div>
                <div class="form-group">
                    <label>Tanggal Kegiatan</label>
                    <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan" value="{{ now()->format('Y-m-d') }}"
                        required oninput="updateDay()">
                </div>
            </div>

            <div class="form-group">
                <label>Tempat Kegiatan</label>
                <textarea name="tempat" rows="2" required>Bank Jateng KCU Surakarta.
Jl. Slamet Riyadi No 20 Surakarta</textarea>
            </div>

            <hr style="margin: 2rem 0; border: 0; border-top: 2px solid var(--gray-200);">
            <h3>Detail SPD</h3>

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
                    <input type="date" id="tgl_berangkat" name="tgl_berangkat"
                        value="{{ now()->format('Y-m-d') }}" required
                        oninput="calculateReturnDate()">
                </div>
                <div class="form-group">
                    <label>Tanggal Harus Kembali</label>
                    <input type="date" id="tgl_kembali" name="tgl_kembali"
                        value="{{ now()->format('Y-m-d') }}" required readonly
                        style="background-color: var(--gray-200); cursor: not-allowed;">
                </div>
            </div>

            <div class="form-group">
                <label>Pembebanan Anggaran (SKPD)</label>
                <input type="text" name="anggaran_skpd" value="Badan Keuangan Daerah" required>
            </div>

            <div class="form-group">
                <label>Penandatangan Surat</label>
                <select name="penandatangan" class="form-control" style="width: 100%; padding: 0.75rem; border: 1px solid var(--gray-200); border-radius: 0.375rem;">
                    <option value="kepala">Kepala Badan Keuangan Daerah</option>
                    <option value="sekretaris">Sekretaris (a.n. Kepala Badan)</option>
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
        function addPegawai() {
            const wrapper = document.getElementById('pegawai-wrapper');
            const firstRow = wrapper.querySelector('.pegawai-row');
            const newRow = firstRow.cloneNode(true);

            // Reset selection
            const select = newRow.querySelector('select');
            select.value = "";
            select.required = false;
            select.options[0].text = "-- Pilih Pengikut --";
            select.style.flex = "1"; // Ensure select takes available space

            // Add remove button if not exists
            if (!newRow.querySelector('.btn-remove')) {
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'btn btn-remove';
                removeBtn.innerHTML = 'X';
                // Override width and padding for compact look
                removeBtn.style.cssText = 'background-color: #ef4444; width: 50px; padding: 0; margin-left: 0; flex-shrink: 0; display: flex; align-items: center; justify-content: center;';
                removeBtn.onclick = function () { this.parentElement.remove(); };
                newRow.appendChild(removeBtn);
            }

            wrapper.appendChild(newRow);
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
            // toISOString() returns "YYYY-MM-DDTHH:mm:ss.sssZ"
            // We splits at T to get the date part.
            // CAUTION: toISOString uses UTC. If local time is significantly different, this might be off.
            // Better to manually construct YYYY-MM-DD string to avoid timezone issues.
            
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