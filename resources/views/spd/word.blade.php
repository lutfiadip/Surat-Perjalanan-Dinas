<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>
<head>
    <meta charset="UTF-8">
    <title>Cetak SPD</title>
    <style>
        /* Basic Reset */
        body, p, h1, h2, h3, h4, table, td, th {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            line-height: 1.15;
        }
        
        /* Word Page Setup */
        @page Section1 {
            size: 21.0cm 29.7cm; /* A4 */
            margin: 1.5cm 2.0cm 1.5cm 2.0cm;
            mso-header-margin: 35.4pt;
            mso-footer-margin: 35.4pt;
            mso-paper-source: 0;
        }
        
        div.Section1 {
            page: Section1;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            mso-table-layout-alt: fixed;
        }
        td {
            vertical-align: top;
            padding: 2px;
        }
        
        /* Helpers */
        .bold { font-weight: bold; }
        .center { text-align: center; }
        .justify { text-align: justify; }
        .border { border: 1px solid black; }
    </style>
</head>
<body>

<div class="Section1">
    <!-- ========================================== -->
    <!-- HALAMAN 1: SURAT TUGAS -->
    <!-- ========================================== -->
    
    <!-- KOP SURAT -->
    <table style="border-bottom: 3px double #000; margin-bottom: 20px;">
        <tr>
            <td style="width: 80px; text-align: center; vertical-align: middle;">
                <?php 
                    $path = public_path('img/logo.png');
                    $base64 = '';
                    if(file_exists($path)) {
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $dataimg = file_get_contents($path);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataimg);
                    }
                ?>
                @if($base64)
                    <img src="{{ $base64 }}" width="70" height="auto" alt="Logo">
                @else
                    [LOGO]
                @endif
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <h3 style="font-size: 12pt; font-weight: normal; margin: 0;">PEMERINTAH KABUPATEN KARANGANYAR</h3>
                <h2 style="font-size: 16pt; font-weight: bold; margin: 0;">BADAN KEUANGAN DAERAH</h2>
                <p style="font-size: 9pt; margin: 1px 0;">Jalan KH.Wachid Hasyim Nomor .2 Karanganyar, Provinsi Jawa Tengah</p>
                <p style="font-size: 9pt; margin: 1px 0;">Kode Pos 57713 Telp.(0271) 495066 , 495138 Fax. (0271) 6491366</p>
                <p style="font-size: 9pt; margin: 1px 0;">Laman : www.bkd.karanganyar.go.id Pos-el : bkd@karanganyarkab.go.id</p>
            </td>
        </tr>
    </table>

    <!-- TITLE -->
    <br>
    <!-- Explicit inline bold for safety -->
    <div class="center" style="font-size: 12pt; margin-bottom: 5px; font-weight: bold;">SURAT TUGAS</div>
    <div class="center" style="margin-bottom: 20px; font-weight: bold;">Nomor : {{ $data['nomor_surat'] }}</div>
    
    <div class="center" style="margin-bottom: 20px;">Kepala Badan Keuangan Daerah</div>

    <!-- BERDASARKAN -->
    <table style="margin-bottom: 30px;">
        <tr>
            <td style="width: 100px; vertical-align: top;">Berdasarkan</td>
            <td style="width: 20px; text-align: center; vertical-align: top;">:</td>
            <td class="justify" style="vertical-align: top;">
                {!! str_replace('Jawa Tengah', 'Jawa Tengah<br>', $data['dasar_surat']) !!}
            </td>
        </tr>
    </table>

    <div class="center" style="margin: 15px 0 25px 0;">memberikan perintah</div>

    <!-- KEPADA -->
    <!-- Increased margin to 35px to give a clear 'enter' look but not too huge -->
    <table style="margin-bottom: 35px;">
        <tr>
            <td style="width: 100px;">Kepada</td>
            <td style="width: 20px; text-align: center;">:</td>
            <td>
                @foreach($selectedPegawais as $index => $pegawai)
                    <table style="margin-bottom: 10px;">
                        <tr>
                            <td style="width: 20px;">{{ $index + 1 }}.</td>
                            <td>
                                <table>
                                    <tr><td style="width: 100px;">Nama</td><td style="width: 10px;">:</td><td>{{ $pegawai->nama }}</td></tr>
                                    <tr><td>Pangkat / Gol</td><td>:</td><td>{{ $pegawai->pangkat_gol }}</td></tr>
                                    <tr><td>NIP</td><td>:</td><td>{{ $pegawai->nip }}</td></tr>
                                    <tr><td>Jabatan</td><td>:</td><td>{{ $pegawai->jabatan }}</td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                @endforeach
            </td>
        </tr>
    </table>

    <!-- UNTUK -->
    <table style="margin-bottom: 10px;">
        <tr>
            <td style="width: 100px;">Untuk</td>
            <td style="width: 20px; text-align: center;">:</td>
            <td>
                <!-- 1 -->
                <!-- Increased margin to 25px based on user feedback -->
                <table style="margin-bottom: 15px;">
                    <tr>
                        <td style="width: 20px;">1.</td>
                        <td>
                            {{ $data['maksud'] }}, yang diselenggarakan pada:<br>
                            <table style="margin-top: 5px;">
                                <tr><td style="width: 80px;">Hari</td><td style="width: 10px;">:</td><td>{{ $data['hari'] }}</td></tr>
                                <tr><td>Tanggal</td><td>:</td><td>{{ $data['tanggal_kegiatan'] }}</td></tr>
                                <tr><td>Tempat</td><td>:</td><td>{!! nl2br(e($data['tempat'])) !!}</td></tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <!-- 2 -->
                <table style="margin-bottom: 10px;">
                    <tr>
                        <td style="width: 20px;">2.</td>
                        <td>Melaporkan hasil tugas kepada pejabat yang bersangkutan.</td>
                    </tr>
                </table>
                <!-- 3 -->
                <table style="margin-bottom: 25px;">
                    <tr>
                        <td style="width: 20px;">3.</td>
                        <td>Dengan diterbitkannya Surat Perintah Tugas ini, maka segala biaya yang timbul dibebankan pada APBD Kabupaten Karanganyar Tahun Anggaran {{ date('Y') }}.</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- SIGNATURE -->
    <table style="margin-top: 30px;">
        <tr>
            <td style="width: 50%;"></td>
            <td style="width: 50%;">
                <br>
                22 Desember 2025<br>
                Kepala Badan Keuangan Daerah
                <br><br><br><br><br>
                <div>{{ $signatory['nama'] }}</div>
                <div>{{ $signatory['pangkat'] }}</div>
                <div>NIP. {{ $signatory['nip'] }}</div>
            </td>
        </tr>
    </table>

    <!-- ========================================== -->
    <!-- HALAMAN 2: SPD DEPAN -->
    <!-- ========================================== -->
    <br clear=all style='mso-special-character:line-break;page-break-before:always'>

    <!-- KOP SURAT (Repeat) -->
    <table style="border-bottom: 3px double #000; margin-bottom: 10px;">
        <tr>
            <td style="width: 80px; text-align: center; vertical-align: middle;">
                @if($base64)
                    <img src="{{ $base64 }}" width="70" height="auto" alt="Logo">
                @else
                    [LOGO]
                @endif
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <h3 style="font-size: 12pt; font-weight: normal; margin: 0;">PEMERINTAH KABUPATEN KARANGANYAR</h3>
                <h2 style="font-size: 16pt; font-weight: bold; margin: 0;">BADAN KEUANGAN DAERAH</h2>
                <p style="font-size: 9pt; margin: 1px 0;">Jalan KH.Wachid Hasyim Nomor .2 Karanganyar, Jawa Tengah 57712</p>
                <p style="font-size: 9pt; margin: 1px 0;">Telepon (0271) 495066,495138 Faksimile (0271) 6491366,</p>
                <p style="font-size: 9pt; margin: 1px 0;">Laman: www.bkd.karanganyar.go.id Pos-el : bkd@karanganyarkab.go.id</p>
            </td>
        </tr>
    </table>

    <div style="text-align: right; margin-right: 50px; font-size: 10pt;">
        <table style="width: 250px; margin-left: auto; border: none;">
            <tr><td style="padding: 1px;">Lembar ke</td><td>:</td><td>.........................</td></tr>
            <tr><td style="padding: 1px;">Kode No</td><td>:</td><td>.........................</td></tr>
            <tr><td style="padding: 1px;">Nomor</td><td>:</td><td>.........................</td></tr>
        </table>
    </div>

    <div class="center bold" style="text-decoration: underline; font-size: 12pt; margin-top: 15px; margin-bottom: 15px;">SURAT PERJALANAN DINAS (SPD)</div>

    <table class="border" style="font-size: 10pt;">
        <colgroup>
            <col style="width: 30px;">
            <col style="width: 250px;">
            <col style="width: auto;">
        </colgroup>
        <tr>
            <td class="border center">1</td>
            <td class="border">Pengguna Anggaran / Kuasa Pengguna Anggaran</td>
            <td class="border">{{ $signatory['nama'] }}</td>
        </tr>
        <tr>
            <td class="border center">2</td>
            <td class="border">Nama /NIP Pegawai yang Melaksanakan Perjalanan Dinas</td>
            <td class="border">
                {{ $selectedPegawais->first()->nama }}<br>
                {{ $selectedPegawais->first()->nip }}
            </td>
        </tr>
        <tr>
            <td class="border center">3</td>
            <td class="border">
                a. Pangkat dan Golongan<br>
                b. Jabatan / Instansi<br>
                c. Tingkat Biaya Perjalanan Dinas
            </td>
            <td class="border">
                a. {{ $selectedPegawais->first()->pangkat_gol }}<br>
                b. {{ $selectedPegawais->first()->jabatan }}<br>
                c. 
            </td>
        </tr>
        <tr>
            <td class="border center">4</td>
            <td class="border">Maksud Perjalanan Dinas</td>
            <td class="border">{{ $data['maksud'] }}</td>
        </tr>
        <tr>
            <td class="border center">5</td>
            <td class="border">Alat Angkut yang Digunakan</td>
            <td class="border">{{ $data['alat_angkut'] }}</td>
        </tr>
        <tr>
            <td class="border center">6</td>
            <td class="border">
                a. Tempat Berangkat<br>
                b. Tempat Tujuan
            </td>
            <td class="border">
                a. {{ $data['tempat_berangkat'] }}<br>
                b. {!! nl2br(e($data['tempat'])) !!}
            </td>
        </tr>
        <tr>
            <td class="border center">7</td>
            <td class="border">
                a. Lama Perjalanan Dinas<br>
                b. Tanggal Berangkat<br>
                c. Tanggal Harus Kembali
            </td>
            <td class="border">
                a. {{ $data['lama_perjalanan'] }}<br>
                b. {{ $data['tgl_berangkat'] }}<br>
                c. {{ $data['tgl_kembali'] }}
            </td>
        </tr>
        <tr>
            <td class="border center">8</td>
            <td class="border">Pengikut</td>
            <td class="border">
                @if($selectedPegawais->count() > 1)
                    @foreach($selectedPegawais->slice(1) as $index => $pengikut)
                        {{ $loop->iteration }}. {{ $pengikut->nama }}, {{ $pengikut->pangkat_gol }}<br>
                    @endforeach
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <td class="border center">9</td>
            <td class="border">
                Pembebanan Anggaran<br>
                a. SKPD<br>
                b. Kode Rekening
            </td>
            <td class="border">
                <br>
                a. {{ $data['anggaran_skpd'] }}<br>
                b.
            </td>
        </tr>
        <tr>
            <td class="border center">10</td>
            <td class="border">Keterangan Lain - Lain</td>
            <td class="border"></td>
        </tr>
    </table>

    <table style="margin-top: 20px; font-size: 10pt;">
        <tr>
            <td style="width: 50%;"></td>
            <td style="width: 50%;">
                <div>Di keluarkan di Karanganyar</div>
                <div>Tanggal {{ $data['tanggal_surat'] }}</div>
                <div>Pengguna Anggaran / Kuasa Pengguna Anggaran,</div>
                <br><br><br><br>
                <div>({{ $signatory['nama'] }})</div>
                <div>NIP. {{ $signatory['nip'] }}</div>
            </td>
        </tr>
    </table>

    <!-- ========================================== -->
    <!-- HALAMAN 3: SPD BELAKANG (VISAS) -->
    <!-- ========================================== -->
    <br clear=all style='mso-special-character:line-break;page-break-before:always'>

    <table class="border" style="font-size: 9pt;">
         <colgroup>
            <col style="width: 30px;">
            <col style="width: 45%;">
            <col style="width: 50%;">
         </colgroup>
         
         <!-- I -->
         <tr>
             <td colspan="2" class="border"></td>
             <td class="border" style="padding: 10px;">
                I. Berangkat dari : (tempat kedudukan)<br>
                &nbsp;&nbsp;&nbsp;Ke : {!! nl2br(e($data['tempat'])) !!}<br>
                &nbsp;&nbsp;&nbsp;Pada Tanggal : {{ $data['tgl_berangkat'] }}
                <br><br>
                <div style="margin-left: 20px;">
                    <div>{{ $pptk['jabatan'] }},</div>
                    <div>Selaku Pejabat Pelaksana Teknis Kegiatan</div>
                    <div>Sekretariat</div>
                    <br><br><br>
                    <div>({{ $pptk['nama'] }})</div>
                    <div>NIP. {{ $pptk['nip'] }}</div>
                </div>
             </td>
         </tr>

         <!-- II, III, IV, V -->
         @foreach(['II', 'III', 'IV', 'V'] as $romawi)
         <tr>
             <td class="border center" style="vertical-align: top;">{{ $romawi }}</td>
             <td class="border" style="padding: 5px;">
                 Tiba :<br>
                 Pada tanggal :<br>
                 <br>
                 Kepala .......................................
                 <br><br><br>
                 (...................................................)<br>
                 NIP.
             </td>
             <td class="border" style="padding: 5px;">
                 Berangkat dari :<br>
                 Pada tanggal :<br>
                 <br>
                 Kepala .......................................
                 <br><br><br>
                 (...................................................)<br>
                 NIP.
             </td>
         </tr>
         @endforeach

         <!-- VI -->
         <tr>
             <td class="border center">VI</td>
             <td class="border" style="padding: 5px;">
                 Tiba : di Karanganyar<br>
                 Pada tanggal : {{ $data['tgl_kembali'] }}<br>
                 <br>
                 Kepala Badan Keuangan Daerah
                 <br><br><br>
                 <div>({{ $signatory['nama'] }})</div>
                 <div>NIP. {{ $signatory['nip'] }}</div>
             </td>
             <td class="border justify" style="padding: 5px;">
                 SPD telah diperiksa dengan keterangan bahwa perjalanan tersebut di atas benar dilakukan atas perintah sesuai dengan kepentingan jabatan dan dilaksanakan dalam waktu yang sesingkat-singkatnya.
             </td>
         </tr>

         <!-- VII -->
         <tr>
             <td class="border center">VII</td>
             <td colspan="2" class="border" style="padding: 5px;">
                 Catatan Lain Lain
             </td>
         </tr>

         <!-- VIII -->
         <tr>
             <td class="border center">VIII</td>
             <td colspan="2" class="border justify" style="padding: 5px;">
                 <div class="bold">PERHATIAN :</div>
                 Pengguna anggaran/kuasa pengguna anggaran yang menerbitkan SPD, pejabat/pegawai/pihak lain yang melakukan perjalanan dinas, pejabat yang mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan peraturan-peraturan keuangan daerah apabila negara menderita rugi akibat kesalahan, kelalaian, dan kealpaannya.
             </td>
         </tr>
    </table>

</div>
</body>
</html>