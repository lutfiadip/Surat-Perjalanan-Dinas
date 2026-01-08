<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak SPD</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            line-height: 1.2;
            color: #000;
        }
        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 10mm 15mm;
            margin: 0 auto;
            background: white;
            box-sizing: border-box;
            position: relative;
        }
        
        /* KOP SURAT */
        .kop-container {
            display: flex;
            align-items: center;
            border-bottom: 4px double #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .kop-logo {
            width: 70px;
            height: auto;
            margin-right: 15px;
        }
        .kop-text {
            text-align: center;
            flex: 1;
        }
        .kop-text h3 {
            font-size: 12pt;
            margin: 0;
            font-weight: normal;
        }
        .kop-text h2 {
            font-size: 16pt;
            margin: 0;
            font-weight: bold;
        }
        .kop-text p {
            font-size: 9pt;
            margin: 2px 0;
        }

        /* BODY SURAT */
        .title-surat {
            text-align: center;
            font-weight: bold;
            font-size: 12pt;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }
        .nomor-surat {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .section-row {
            display: flex;
            margin-bottom: 8px;
        }
        .label-col {
            width: 100px;
            flex-shrink: 0;
            font-weight: normal; 
        }
        .colon-col {
            width: 20px;
            text-align: center;
            font-weight: bold;
        }
        .value-col {
            flex: 1;
            text-align: justify;
        }

        /* KEPADA LIST */
        .kepada-list-item {
            display: flex;
            margin-bottom: 4px;
        }
        .kepada-num {
            width: 20px;
            flex-shrink: 0;
        }
        .kepada-content {
            flex: 1;
        }
        .kepada-row {
            display: flex;
        }
        .k-label {
            width: 100px; 
        }
        .k-colon {
            width: 15px;
            text-align: center;
        }
        .k-val {
            flex: 1;
        }

        /* UNTUK LIST */
        .untuk-item {
            display: flex;
            margin-bottom: 5px;
            align-items: flex-start;
        }
        .disk-row {
             display: flex;
        }

        /* SIGNATURE */
        .signature-container {
            float: right;
            width: 300px;
            margin-top: 15px;
            text-align: left;
        }

        /* SPD TABLE SPECIFIC */
        .spd-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
            font-family: Arial, Helvetica, sans-serif;
        }
        .spd-table td {
            border: 1px solid #000;
            padding: 3px;
            vertical-align: top;
        }

        @media print {
            body, html {
                width: 100%;
                height: auto;
            }
            .page {
                width: 210mm;
                height: auto;
                min-height: 0;
                margin: 0;
                padding: 10mm 15mm;
                box-shadow: none;
                border: none;
                overflow: hidden;
                page-break-after: always;
            }
            .page:last-child {
                page-break-after: auto;
            }
        }
    </style>
</head>
<body>

    <!-- HALAMAN 1: SURAT TUGAS -->
    <div class="page">
        <!-- KOP SURAT -->
        <div class="kop-container">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="kop-logo">
            <div class="kop-text">
                <h3>PEMERINTAH KABUPATEN KARANGANYAR</h3>
                <h2>BADAN KEUANGAN DAERAH</h2>
                <p>Jalan KH.Wachid Hasyim Nomor .2 Karanganyar, Provinsi Jawa Tengah</p>
                <p>Kode Pos 57713 Telp.(0271) 495066 , 495138 Fax. (0271) 6491366</p>
                <p>Laman : www.bkd.karanganyar.go.id Pos-el : bkd@karanganyarkab.go.id</p>
            </div>
        </div>

        <div class="title-surat">SURAT TUGAS</div>
        <div class="nomor-surat">Nomor : {{ $data['nomor_surat'] }}</div>
        
        <div style="text-align: center; font-weight: normal; margin-bottom: 5px;">Kepala Badan Keuangan Daerah</div>

        <div class="section-row">
            <div class="label-col">Berdasarkan</div>
            <div class="colon-col">:</div>
            <div class="value-col">{{ $data['dasar_surat'] }}</div>
        </div>

        <div style="text-align: center; margin: 10px 0;">memberikan perintah</div>

        <div class="section-row">
            <div class="label-col">Kepada</div>
            <div class="colon-col">:</div>
            <div class="value-col">
                @foreach($selectedPegawais as $index => $pegawai)
                    <div class="kepada-list-item">
                        <div class="kepada-num">{{ $index + 1 }}.</div>
                        <div class="kepada-content">
                            <div class="kepada-row"><div class="k-label">Nama</div><div class="k-colon">:</div><div class="k-val">{{ $pegawai->nama }}</div></div>
                            <div class="kepada-row"><div class="k-label">Pangkat / Gol</div><div class="k-colon">:</div><div class="k-val">{{ $pegawai->pangkat_gol }}</div></div>
                            <div class="kepada-row"><div class="k-label">NIP</div><div class="k-colon">:</div><div class="k-val">{{ $pegawai->nip }}</div></div>
                            <div class="kepada-row"><div class="k-label">Jabatan</div><div class="k-colon">:</div><div class="k-val">{{ $pegawai->jabatan }}</div></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="section-row">
            <div class="label-col">Untuk</div>
            <div class="colon-col">:</div>
            <div class="value-col">
                <div class="untuk-item">
                    <div class="kepada-num">1.</div>
                    <div class="kepada-content">
                        {{ $data['maksud'] }}, yang diselenggarakan pada:<br>
                        <div class="disk-row" style="margin-top: 5px;"><div class="k-label">Hari</div><div class="k-colon">:</div><div class="k-val">{{ $data['hari'] }}</div></div>
                        <div class="disk-row"><div class="k-label">Tanggal</div><div class="k-colon">:</div><div class="k-val">{{ $data['tanggal_kegiatan'] }}</div></div>
                        <div class="disk-row"><div class="k-label">Tempat</div><div class="k-colon">:</div><div class="k-val">{!! nl2br(e($data['tempat'])) !!}</div></div>
                    </div>
                </div>
                <div class="untuk-item">
                    <div class="kepada-num">2.</div>
                    <div class="kepada-content">Melaporkan hasil tugas kepada pejabat yang bersangkutan.</div>
                </div>
                <div class="untuk-item">
                    <div class="kepada-num">3.</div>
                    <div class="kepada-content">Dengan diterbitkannya Surat Perintah Tugas ini, maka segala biaya yang timbul dibebankan pada APBD Kabupaten Karanganyar Tahun Anggaran {{ date('Y') }}.</div>
                </div>
            </div>
        </div>

        <div class="signature-container">
            <div style="margin-bottom: 20mm;">
                22 Desember 2025<br>
                Kepala Badan Keuangan Daerah
            </div>
            <div style="font-weight: bold;">{{ $signatory['nama'] }}</div>
            <div>{{ $signatory['pangkat'] }}</div>
            <div>NIP. {{ $signatory['nip'] }}</div>
        </div>

    </div>

    <!-- HALAMAN 2: SURAT PERJALANAN DINAS (SPD) -->
    <div class="page" style="font-family: Arial, Helvetica, sans-serif;">
         <!-- KOP SURAT SAME AS PAGE 1 -->
        <div class="kop-container">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="kop-logo">
            <div class="kop-text">
                <h3>PEMERINTAH KABUPATEN KARANGANYAR</h3>
                <h2>BADAN KEUANGAN DAERAH</h2>
                <p>Jalan KH.Wachid Hasyim Nomor .2 Karanganyar, Jawa Tengah 57712</p>
                <p>Telepon (0271) 495066,495138 Faksimile (0271) 6491366,</p>
                <p>Laman: www.bkd.karanganyar.go.id Pos-el: bkd@karanganyarkab.go.id</p>
            </div>
        </div>

        <!-- LEMBAR INFO BLOCK (Centered) -->
        <div style="display: flex; justify-content: center; margin-bottom: 10px;">
            <table style="font-size: 10pt; border: none;">
                <tr>
                    <td style="border: none; padding: 1px 10px;">Lembar ke</td>
                    <td style="border: none; padding: 1px;">:</td>
                    <td style="border: none; padding: 1px;">............................................................</td>
                </tr>
                <tr>
                    <td style="border: none; padding: 1px 10px;">Kode No</td>
                    <td style="border: none; padding: 1px;">:</td>
                    <td style="border: none; padding: 1px;">............................................................</td>
                </tr>
                <tr>
                    <td style="border: none; padding: 1px 10px;">Nomor</td>
                    <td style="border: none; padding: 1px;">:</td>
                    <td style="border: none; padding: 1px;">............................................................</td>
                </tr>
            </table>
        </div>

        <div style="text-align: center; font-weight: normal; text-decoration: underline; font-size: 11pt; margin-bottom: 8px;">SURAT PERJALANAN DINAS (SPD)</div>
        
        <table class="spd-table">
            <colgroup>
                <col style="width: 30px;">
                <col style="width: 250px;">
                <col style="width: auto;">
            </colgroup>
            <tr>
                <td style="text-align: center;">1</td>
                <td>Pengguna Anggaran / Kuasa Pengguna Anggaran</td>
                <td>{{ $signatory['nama'] }}</td>
            </tr>
            <tr>
                <td style="text-align: center;">2</td>
                <td>Nama /NIP Pegawai yang Melaksanakan Perjalanan Dinas</td>
                <td>
                    {{ $selectedPegawais->first()->nama }}<br>
                    {{ $selectedPegawais->first()->nip }}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">3</td>
                <td>
                    a. Pangkat dan Golongan<br>
                    b. Jabatan / Instansi<br>
                    c. Tingkat Biaya Perjalanan Dinas
                </td>
                <td>
                    a. {{ $selectedPegawais->first()->pangkat_gol }}<br>
                    b. {{ $selectedPegawais->first()->jabatan }}<br>
                    c. 
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">4</td>
                <td>Maksud Perjalanan Dinas</td>
                <td>{{ $data['maksud'] }}</td>
            </tr>
            <tr>
                <td style="text-align: center;">5</td>
                <td>Alat Angkut yang Digunakan</td>
                <td>{{ $data['alat_angkut'] }}</td>
            </tr>
            <tr>
                <td style="text-align: center;">6</td>
                <td>
                    a. Tempat Berangkat<br>
                    b. Tempat Tujuan
                </td>
                <td>
                    a. {{ $data['tempat_berangkat'] }}<br>
                    b. {!! nl2br(e($data['tempat'])) !!}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">7</td>
                <td>
                    a. Lama Perjalanan Dinas<br>
                    b. Tanggal Berangkat<br>
                    c. Tanggal Harus Kembali
                </td>
                <td>
                    a. {{ $data['lama_perjalanan'] }}<br>
                    b. {{ $data['tgl_berangkat'] }}<br>
                    c. {{ $data['tgl_kembali'] }}
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">8</td>
                <td>Pengikut</td>
                <td>
                    @if($selectedPegawais->count() > 1)
                        @foreach($selectedPegawais->slice(1) as $index => $pengikut)
                            {{ $loop->iteration }}. {{ $pengikut->nama }}, {{ $pengikut->pangkat_gol }}<br>
                        @endforeach
                    @else
                        
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">9</td>
                <td>
                    Pembebanan Anggaran<br>
                    a. SKPD<br>
                    b. Kode Rekening
                </td>
                <td>
                    <br>
                    a. {{ $data['anggaran_skpd'] }}<br>
                    b.
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">10</td>
                <td>Keterangan Lain - Lain</td>
                <td></td>
            </tr>
        </table>
        
        <div class="signature-container" style="margin-top: 15px;">
            <div>Di keluarkan di Karanganyar</div>
            <div style="margin-bottom: 20mm;">
                Tanggal {{ $data['tanggal_surat'] }}<br>
                Pengguna Anggaran / Kuasa Pengguna Anggaran,
            </div>
            
            <div style="font-weight: bold;">({{ $signatory['nama'] }})</div>
            <div>NIP. {{ $signatory['nip'] }}</div>
        </div>
    </div>
    
    <!-- HALAMAN 3: VISAS -->
    <div class="page" style="page-break-before: always; font-family: Arial, Helvetica, sans-serif;">
        <table style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif; font-size: 9pt; border: 1px solid black;">
             <colgroup>
                <col style="width: 30px; border: 1px solid black;">
                <col style="width: 45%; border: 1px solid black;">
                <col style="width: 50%; border: 1px solid black;">
             </colgroup>
             
             <!-- ROW I -->
             <tr style="height: 140px;">
                 <td colspan="2" style="border: 1px solid black;"></td>
                 <td style="border: 1px solid black; vertical-align: top; padding: 3px;">
                    <table style="width: 100%; border: none; font-size: 9pt;">
                        <tr>
                            <td style="width: 15px; vertical-align: top;">I.</td>
                            <td style="width: 120px; vertical-align: top;">
                                Berangkat dari<br>
                                (tempat kedudukan)
                            </td>
                            <td style="vertical-align: top;">: {{ $data['tempat_berangkat'] }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="vertical-align: top;">Ke</td>
                            <td style="vertical-align: top;">
                                : {!! nl2br(e($data['tempat'])) !!}
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="vertical-align: top;">Pada Tanggal</td>
                            <td style="vertical-align: top;">: {{ $data['tgl_berangkat'] }}</td>
                        </tr>
                    </table>
                    <div style="margin-top: 2px; margin-left: 19px;">
                        <div>{{ $pptk['jabatan'] }},</div>
                        <div>Selaku Pejabat Pelaksana Teknis Kegiatan</div>
                        <div>Sekretariat</div>
                        <br><br><br>
                        <div style="font-weight: bold;">({{ $pptk['nama'] }})</div>
                        <div>NIP. {{ $pptk['nip'] }}</div>
                    </div>
                 </td>
             </tr>

             <!-- ROW II, III, IV, V -->
             @foreach(['II', 'III', 'IV', 'V'] as $romawi)
             <!-- Sub-row 1: Label -->
             <tr>
                 <td rowspan="3" style="border: 1px solid black; vertical-align: top; padding: 1px; text-align: center;">{{ $romawi }}</td>
                 <td style="border: 1px solid black; vertical-align: top; padding: 1px;">Tiba :</td>
                 <td style="border: 1px solid black; vertical-align: top; padding: 1px;">Berangkat dari :</td>
             </tr>
             <!-- Sub-row 2: Date -->
             <tr>
                 <td style="border: 1px solid black; vertical-align: top; padding: 1px;">Pada tanggal :</td>
                 <td style="border: 1px solid black; vertical-align: top; padding: 1px;">Pada tanggal :</td>
             </tr>
             <!-- Sub-row 3: Signature Header -->
             <tr>
                 <td style="border: 1px solid black; vertical-align: top; padding: 1px; height: 75px;">
                     <div>Kepala .......................................</div>
                     <div style="margin-top: 35px;">(...................................................)</div>
                     <div>NIP.</div>
                 </td>
                 <td style="border: 1px solid black; vertical-align: top; padding: 1px;">
                     <div>Kepala .......................................</div>
                     <div style="margin-top: 35px;">(...................................................)</div>
                     <div>NIP.</div>
                 </td>
             </tr>
             @endforeach

             <!-- ROW VI -->
             <tr>
                 <td rowspan="3" style="border: 1px solid black; vertical-align: top; padding: 1px; text-align: center;">VI</td>
                 <td style="border: 1px solid black; vertical-align: top; padding: 1px;">Tiba : di Karanganyar</td>
                 <td rowspan="3" style="border: 1px solid black; vertical-align: top; padding: 2px; text-align: justify;">
                     SPD telah diperiksa dengan keterangan bahwa perjalanan tersebut di atas benar dilakukan atas perintah sesuai dengan kepentingan jabatan dan dilaksanakan dalam waktu yang sesingkat-singkatnya.
                 </td>
             </tr>
             <tr>
                 <td style="border: 1px solid black; vertical-align: top; padding: 1px;">Pada tanggal : {{ $data['tgl_kembali'] }}</td>
             </tr>
             <tr>
                 <td style="border: 1px solid black; vertical-align: top; padding: 1px; height: 85px;">
                     <div>Kepala Badan Keuangan Daerah</div>
                     <div style="margin-top: 40px; font-weight: bold;">({{ $signatory['nama'] }})</div>
                     <div>NIP. {{ $signatory['nip'] }}</div>
                 </td>
             </tr>

             <!-- ROW VII -->
             <tr>
                 <td style="border: 1px solid black; vertical-align: top; padding: 1px; text-align: center;">VII</td>
                 <td colspan="2" style="border: 1px solid black; vertical-align: top; padding: 1px;">
                     Catatan Lain Lain
                 </td>
             </tr>

             <!-- ROW VIII -->
             <tr>
                 <td style="border: 1px solid black; vertical-align: top; padding: 1px; text-align: center;">VIII</td>
                 <td colspan="2" style="border: 1px solid black; vertical-align: top; padding: 1px; text-align: justify;">
                     <div style="font-weight: bold;">PERHATIAN :</div>
                     Pengguna anggaran/kuasa pengguna anggaran yang menerbitkan SPD, pejabat/pegawai/pihak lain yang melakukan perjalanan dinas, pejabat yang mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan peraturan-peraturan keuangan daerah apabila negara menderita rugi akibat kesalahan, kelalaian, dan kealpaannya.
                 </td>
             </tr>

        </table>

    </div>
    
    <script>
        window.print();
    </script>
</body>
</html>