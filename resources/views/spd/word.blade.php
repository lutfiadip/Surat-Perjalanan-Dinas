<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word'
    xmlns='http://www.w3.org/TR/REC-html40'>

<head>
    <meta charset="UTF-8">
    <title>Cetak SPD</title>
    <style>
        /* Basic Reset */
        body,
        p,
        h1,
        h2,
        h3,
        h4,
        table,
        td,
        th {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            line-height: 1.15;
        }

        /* Word Page Setup */
        @page Section1 {
            size: 21.0cm 29.7cm;
            /* A4 */
            margin: 1.5cm 2.0cm 1.5cm 2.0cm;
            mso-header-margin: 35.4pt;
            mso-footer-margin: 35.4pt;
            mso-paper-source: 0;
        }

        div.Section1 {
            page: Section1;
        }

        /* Page 2 (New Section) */
        @page Section2 {
            size: 21.0cm 29.7cm;
            /* A4 */
            margin: 1.5cm 1.0cm 1.5cm 2.0cm;
            mso-header-margin: 35.4pt;
            mso-footer-margin: 35.4pt;
            mso-paper-source: 0;
        }

        div.Section2 {
            page: Section2;
        }

        /* Tighter margins for Page 3 (Back Page) */
        @page Section3 {
            size: 21.0cm 29.7cm;
            /* A4 */
            margin: 1.27cm 1.0cm 0.3cm 2.0cm;
            /* Top relaxed, Bottom tight */
            mso-header-margin: 0pt;
            mso-footer-margin: 0pt;
            mso-paper-source: 0;
        }

        div.Section3 {
            page: Section3;
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
        .bold {
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .justify {
            text-align: justify;
        }

        .border {
            border: 1px solid black;
        }

        /* Specific override for Page 3 */
        #page3table,
        #page3table tr,
        #page3table td,
        #page3table th,
        #page3table div,
        #page3table p,
        #page3table span {
            font-size: 10pt !important;
        }
    </style>
</head>

<body>

    <div class="Section1">
        <!-- ========================================== -->
        <!-- HALAMAN 1: SURAT TUGAS -->
        <!-- ========================================== -->

        <!-- KOP SURAT -->
        <table style="border-bottom: 1px solid #000; margin-bottom: 20px;">
            <tr>
                <td style="width: 80px; text-align: center; vertical-align: middle; padding-left: 20px;">
                    <?php 
                    $path = public_path('img/logo.png');
$base64 = '';
if (file_exists($path)) {
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
                    <p style="font-size: 9pt; margin: 1px 0;">Jalan KH.Wachid Hasyim Nomor .2 Karanganyar, Provinsi Jawa
                        Tengah</p>
                    <p style="font-size: 9pt; margin: 1px 0;">Kode Pos 57713 Telp.(0271) 495066 , 495138 Fax. (0271)
                        6491366</p>
                    <p style="font-size: 9pt; margin: 1px 0;">Laman : www.bkd.karanganyar.go.id Pos-el :
                        bkd@karanganyarkab.go.id</p>
                </td>
            </tr>
        </table>

        <!-- TITLE -->

        <!-- Explicit inline bold for safety -->
        <table style="width: 100%; border: none;">
            <tr>
                <td style="padding-left: 30px;">
                    <div class="center"
                        style="font-size: 12pt; margin-bottom: 5px; margin-top: 10px; font-weight: bold;">
                        SURAT
                        TUGAS</div>
                    <table style="width: 100%; border: none; margin-bottom: 20px;">
                        <tr>
                            <td
                                style="width: 35%; text-align: right; border: none; padding-right: 5px; font-weight: bold;">
                                Nomor :
                            </td>
                            <td
                                style="width: 60%; text-align: left; border: none; padding-left: 5px; font-weight: bold;">
                                {{ $data['nomor_surat'] }}
                            </td>
                        </tr>
                    </table>
                    <br>

                    <div class="center" style="margin-bottom: 0px;">Kepala Badan Keuangan Daerah</div>

                    <!-- BERDASARKAN -->
                    <table style="margin-bottom: 30px;">
                        <tr>
                            <td style="width: 100px; vertical-align: top;">Berdasarkan</td>
                            <td style="width: 20px; text-align: center; vertical-align: top;">:</td>
                            <td class="justify" style="vertical-align: top;">
                                {!! str_replace('Nomor:', '<br>Nomor:', $data['dasar_surat']) !!}
                            </td>
                        </tr>
                    </table>

                    <div class="center" style="margin: 15px 0 25px 0;">memberikan perintah</div>

                    <!-- KEPADA -->
                    <table style="margin-bottom: 0px;">
                        <tr>
                            <td style="width: 60px;">Kepada</td>
                            <td style="width: 20px; text-align: center;">:</td>
                            <td>
                                @foreach($selectedPegawais as $index => $pegawai)
                                    <table style="margin-bottom: 10px;">
                                        <tr>
                                            <td style="width: 20px;">{{ $index + 1 }}.</td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td style="width: 100px;">Nama</td>
                                                        <td style="width: 10px;">:</td>
                                                        <td>{{ $pegawai->nama }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pangkat / Gol</td>
                                                        <td>:</td>
                                                        <td>{{ $pegawai->pangkat_gol }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>NIP</td>
                                                        <td>:</td>
                                                        <td>{{ $pegawai->nip }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jabatan</td>
                                                        <td>:</td>
                                                        <td>{{ $pegawai->jabatan }}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                    <div style="font-size: 8pt;">&nbsp;</div>

                    <!-- UNTUK -->
                    <!-- UNTUK -->
                    <table style="margin-bottom: 10px;">
                        <tr>
                            <td style="width: 60px;">Untuk</td>
                            <td style="width: 20px; text-align: center;">:</td>
                            <td>
                                <!-- 1 -->
                                <table style="margin-bottom: 0px;">
                                    <tr>
                                        <td style="width: 20px;">1.</td>
                                        <td style="vertical-align: top; text-align: justify;">
                                            {{ $data['maksud'] }}, yang diselenggarakan pada:<br>
                                            <table style="margin-top: 5px;">
                                                <tr>
                                                    <td style="width: 80px;">Hari</td>
                                                    <td style="width: 10px;">:</td>
                                                    <td>{{ $data['hari'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal</td>
                                                    <td>:</td>
                                                    <td>{{ $data['tanggal_kegiatan'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tempat</td>
                                                    <td>:</td>
                                                    <td>{!! nl2br(e($data['tempat'])) !!}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <div style="font-size: 8pt;">&nbsp;</div>

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
                                        <td style="text-align: justify;">Dengan diterbitkannya Surat Perintah Tugas ini,
                                            maka segala biaya yang
                                            timbul
                                            dibebankan
                                            pada APBD Kabupaten Karanganyar Tahun Anggaran
                                            {{ $data['tahun_anggaran'] }}.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                    <!-- SIGNATURE -->
                    <table style="margin-top: 10px;">
                        <tr>
                            <td style="width: 50%;"></td>
                            <td style="width: 50%;">
                                {!! $signatory['full_signature_page1'] !!}
                            </td>
                        </tr>
                    </table>
        </table>
        </td>
        </tr>
        </table>

        <!-- ========================================== -->
        <!-- HALAMAN 2: SPD DEPAN -->
        <!-- ========================================== -->
        </div>
        <br clear=all style='page-break-before:always; mso-break-type:section-break'>
        <div class="Section2">

        <!-- KOP SURAT (Repeat) -->
        <table style="border-bottom: 1px solid #000; margin-bottom: 10px;">
            <tr>
                <td style="width: 80px; text-align: center; vertical-align: middle; padding-left: 20px;">
                    @if($base64)
                        <img src="{{ $base64 }}" width="70" height="auto" alt="Logo">
                    @else
                        [LOGO]
                    @endif
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <h3 style="font-size: 12pt; font-weight: normal; margin: 0;">PEMERINTAH KABUPATEN KARANGANYAR</h3>
                    <h2 style="font-size: 16pt; font-weight: bold; margin: 0;">BADAN KEUANGAN DAERAH</h2>
                    <p style="font-size: 9pt; margin: 1px 0;">Jalan KH.Wachid Hasyim Nomor .2 Karanganyar, Jawa Tengah
                        57712</p>
                    <p style="font-size: 9pt; margin: 1px 0;">Telepon (0271) 495066,495138 Faksimile (0271) 6491366,</p>
                    <p style="font-size: 9pt; margin: 1px 0;">Laman: www.bkd.karanganyar.go.id Pos-el :
                        bkd@karanganyarkab.go.id</p>
                </td>
            </tr>
        </table>

        <br>
        <table style="width: 100%; border: none;">
            <tr>
                <td style="padding-left: 30px;">
                    <table style="width: 100%; margin-top: 15px; margin-bottom: 10px; border: none;">
                        <tr>
                            <td style="width: 50%; border: none;"></td>
                            <td style="width: 50%; border: none;">
                                <table style="width: 100%; border: none;">
                                    <tr>
                                        <td style="padding: 1px; white-space: nowrap; width: 100px;">Lembar ke</td>
                                        <td style="width: 10px;">:</td>
                                        <td>............................................................</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 1px; white-space: nowrap;">Kode No</td>
                                        <td>:</td>
                                        <td>............................................................</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 1px; white-space: nowrap;">Nomor</td>
                                        <td>:</td>
                                        <td>............................................................</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                    <div class="center bold"
                        style="text-decoration: underline; font-size: 12pt; margin-top: 15px; margin-bottom: 15px;">
                        SURAT
                        PERJALANAN
                        DINAS (SPD)</div>

                    <table class="border" style="font-size: 10pt; width: 100%; table-layout: fixed;">
                        <colgroup>
                            <col style="width: 7%;">
                            <col style="width: 37%;">
                            <col style="width: 56%;">
                        </colgroup>
                        <tr>
                            <td class="border center" align="center" valign="top"
                                style="padding: 5px; vertical-align: top; width: 7%;">1</td>
                            <td class="border" style="padding: 5px; vertical-align: top; width: 37%;">Pengguna Anggaran
                                / Kuasa
                                Pengguna Anggaran</td>
                            <td class="border" style="padding: 5px; vertical-align: top; width: 56%;">
                                {{ $signatory['nama'] }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border center" align="center" valign="top"
                                style="padding: 5px; vertical-align: top;">2</td>
                            <td class="border" style="padding: 5px; vertical-align: top;">Nama /NIP Pegawai yang
                                Melaksanakan
                                Perjalanan Dinas</td>
                            <td class="border" style="padding: 5px; vertical-align: top;">
                                {{ $selectedPegawais->first()->nama }}<br>
                                {{ $selectedPegawais->first()->nip }}
                            </td>
                        </tr>
                        <!-- Row 3: Merged for Synchronization -->
                        <!-- Row 3a: Pangkat -->
                        <!-- Row 3a: Pangkat -->
                        <tr style="mso-row-margin-right: 0cm;" valign="top">
                            <td rowspan="3" class="border center" align="center" valign="top"
                                style="width: 7%; padding: 1px; vertical-align: top;">3</td>
                            <td class="border"
                                style="width: 37%; padding: 1px 5px 0 5px; mso-padding-alt: 1pt 5.4pt 0cm 5.4pt; vertical-align: top; border-bottom: none;">
                                <table
                                    style="width: 100%; border: none; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0;"
                                    cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td
                                            style="width: 20px; border: none; vertical-align: top; padding: 0; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            <p
                                                style="margin: 0; padding: 0; line-height: 100%; mso-line-height-rule: exactly;">
                                                a.</p>
                                        </td>
                                        <td
                                            style="border: none; vertical-align: top; padding: 0; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            <p
                                                style="margin: 0; padding: 0; line-height: 100%; mso-line-height-rule: exactly;">
                                                Pangkat dan Golongan</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="border"
                                style="width: 56%; padding: 1px 5px 0 5px; mso-padding-alt: 1pt 5.4pt 0cm 5.4pt; vertical-align: top; border-bottom: none;">
                                <table
                                    style="width: 100%; border: none; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0;"
                                    cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td
                                            style="width: 20px; border: none; vertical-align: top; padding: 0; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            <p
                                                style="margin: 0; padding: 0; line-height: 100%; mso-line-height-rule: exactly;">
                                                a.</p>
                                        </td>
                                        <td
                                            style="border: none; vertical-align: top; padding: 0; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            <p
                                                style="margin: 0; padding: 0; line-height: 100%; mso-line-height-rule: exactly;">
                                                {{ $selectedPegawais->first()->pangkat_gol }}
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!-- Row 3b: Jabatan -->
                        <tr style="mso-row-margin-right: 0cm;" valign="top">
                            <td class="border"
                                style="width: 37%; padding: 0 5px 0 5px; mso-padding-alt: 0cm 5.4pt 0cm 5.4pt; vertical-align: top; border-top: none; border-bottom: none;">
                                <table
                                    style="width: 100%; border: none; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0;"
                                    cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td
                                            style="width: 20px; border: none; vertical-align: top; padding: 0; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            <p
                                                style="margin: 0; padding: 0; line-height: 100%; mso-line-height-rule: exactly;">
                                                b.</p>
                                        </td>
                                        <td
                                            style="border: none; vertical-align: top; padding: 0; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            <p
                                                style="margin: 0; padding: 0; line-height: 100%; mso-line-height-rule: exactly;">
                                                Jabatan / Instansi</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="border"
                                style="width: 56%; padding: 0 5px 0 5px; mso-padding-alt: 0cm 5.4pt 0cm 5.4pt; vertical-align: top; border-top: none; border-bottom: none;">
                                <table
                                    style="width: 100%; border: none; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0;"
                                    cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td
                                            style="width: 20px; border: none; vertical-align: top; padding: 0; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            <p
                                                style="margin: 0; padding: 0; line-height: 100%; mso-line-height-rule: exactly;">
                                                b.</p>
                                        </td>
                                        <td
                                            style="border: none; vertical-align: top; padding: 0; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            <p
                                                style="margin: 0; padding: 0; line-height: 100%; mso-line-height-rule: exactly;">
                                                {{ $selectedPegawais->first()->jabatan }}
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!-- Row 3c: Biaya -->
                        <tr style="mso-row-margin-right: 0cm;" valign="top">
                            <td class="border"
                                style="width: 37%; padding: 0 5px 1px 5px; mso-padding-alt: 0cm 5.4pt 1pt 5.4pt; vertical-align: top; border-top: none;">
                                <table
                                    style="width: 100%; border: none; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0;"
                                    cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td
                                            style="width: 20px; border: none; vertical-align: top; padding: 0; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            <p
                                                style="margin: 0; padding: 0; line-height: 100%; mso-line-height-rule: exactly;">
                                                c.</p>
                                        </td>
                                        <td
                                            style="border: none; vertical-align: top; padding: 0; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            <p
                                                style="margin: 0; padding: 0; line-height: 100%; mso-line-height-rule: exactly;">
                                                Tingkat Biaya Perjalanan Dinas</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="border"
                                style="width: 56%; padding: 0 5px 1px 5px; mso-padding-alt: 0cm 5.4pt 1pt 5.4pt; vertical-align: top; border-top: none;">
                                <table
                                    style="width: 100%; border: none; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0;"
                                    cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td
                                            style="width: 20px; border: none; vertical-align: top; padding: 0; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            <p
                                                style="margin: 0; padding: 0; line-height: 100%; mso-line-height-rule: exactly;">
                                                c.</p>
                                        </td>
                                        <td
                                            style="border: none; vertical-align: top; padding: 0; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            <p
                                                style="margin: 0; padding: 0; line-height: 100%; mso-line-height-rule: exactly;">
                                                {{ $data['tingkat_biaya'] ?? '' }}
                                            </p>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="border center" align="center" valign="top"
                                style="padding: 5px; vertical-align: top;">4</td>
                            <td class="border" style="padding: 5px; vertical-align: top;">Maksud Perjalanan Dinas</td>
                            <td class="border" style="padding: 5px; vertical-align: top;">{{ $data['maksud'] }}</td>
                        </tr>
                        <tr>
                            <td class="border center" align="center" valign="top"
                                style="padding: 5px; vertical-align: top;">5</td>
                            <td class="border" style="padding: 5px; vertical-align: top;">Alat Angkut yang Digunakan
                            </td>
                            <td class="border" style="padding: 5px; vertical-align: top;">{{ $data['alat_angkut'] }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border center" align="center" valign="top"
                                style="padding: 5px; vertical-align: top;">6</td>
                            <td class="border" style="padding: 5px; vertical-align: top;">
                                a. Tempat Berangkat<br>
                                b. Tempat Tujuan
                            </td>
                            <td class="border"
                                style="padding: 5px; vertical-align: top; mso-padding-alt: 0cm 5.4pt 0cm 5.4pt;">
                                <table
                                    style="width: 100%; border: none; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0;"
                                    cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td
                                            style="width: 20px; border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            a.</td>
                                        <td
                                            style="border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            {{ $data['tempat_berangkat'] }}</td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="width: 20px; border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            b.</td>
                                        <td
                                            style="border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            {!! nl2br(e($data['tempat'])) !!}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="border center" align="center" valign="top"
                                style="padding: 5px; vertical-align: top;">7</td>
                            <td class="border" style="padding: 5px; vertical-align: top;">
                                a. Lama Perjalanan Dinas<br>
                                b. Tanggal Berangkat<br>
                                c. Tanggal Harus Kembali
                            </td>
                            <td class="border"
                                style="padding: 5px; vertical-align: top; mso-padding-alt: 0cm 5.4pt 0cm 5.4pt;">
                                <table
                                    style="width: 100%; border: none; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0;"
                                    cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td
                                            style="width: 20px; border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            a.</td>
                                        <td
                                            style="border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            {{ $data['lama_perjalanan'] }}</td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="width: 20px; border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            b.</td>
                                        <td
                                            style="border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            {{ $data['tgl_berangkat'] }}</td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="width: 20px; border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            c.</td>
                                        <td
                                            style="border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            {{ $data['tgl_kembali'] }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="border center" align="center" valign="top"
                                style="padding: 5px; vertical-align: top;">8
                            </td>
                            <td class="border" style="padding: 5px; vertical-align: top;">Pengikut</td>
                            <td class="border"
                                style="padding: 5px; vertical-align: top; mso-padding-alt: 0cm 5.4pt 0cm 5.4pt;">
                                @if ($selectedPegawais->count() > 1)
                                    <table
                                        style="width: 100%; border: none; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0;"
                                        cellpadding="0" cellspacing="0">
                                        @foreach ($selectedPegawais->slice(1) as $index => $pengikut)
                                            <tr>
                                                <td
                                                    style="width: 20px; border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                                    {{ $loop->iteration }}.</td>
                                                <td
                                                    style="border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                                    {{ $pengikut->nama }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="border center" align="center" valign="top"
                                style="padding: 5px; vertical-align: top;">9</td>
                            <td class="border" style="padding: 5px; vertical-align: top;">
                                Pembebanan Anggaran<br>
                                a. SKPD<br>
                                b. Kode Rekening
                            </td>
                            <td class="border"
                                style="padding: 5px; vertical-align: top; mso-padding-alt: 0cm 5.4pt 0cm 5.4pt;">
                                <br>
                                <table
                                    style="width: 100%; border: none; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; margin: 0; padding: 0;"
                                    cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td
                                            style="width: 20px; border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            a.</td>
                                        <td
                                            style="border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            {{ $data['anggaran_skpd'] }}</td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="width: 20px; border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            b.</td>
                                        <td
                                            style="border: none; padding: 0; vertical-align: top; mso-padding-alt: 0cm 0cm 0cm 0cm;">
                                            {{ $data['kode_rekening'] ?? '' }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="border center" align="center" valign="top"
                                style="padding: 5px; vertical-align: top;">
                                10</td>
                            <td class="border" style="padding: 5px; vertical-align: top;">Keterangan Lain - Lain</td>
                            <td class="border"
                                style="padding: 5px; vertical-align: top; word-wrap: break-word; word-break: break-all;">
                                {!! nl2br(e($data['keterangan_lain'] ?? '')) !!}</td>
                        </tr>
                    </table>

                    <table style="margin-top: 20px; font-size: 10pt;">
                        <tr>
                            <td style="width: 50%;"></td>
                            <td style="width: 50%;">
                                <br>
                                <div>Di keluarkan di Karanganyar</div>
                                <div>Tanggal {{ $data['tanggal_surat'] }}</div>
                                <div>Pengguna Anggaran / Kuasa Pengguna Anggaran,</div>
                                <br><br><br><br>
                                <div>({{ $signatory['nama'] }})</div>
                                <div>NIP. {{ $signatory['nip'] }}</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- ========================================== -->
        <!-- HALAMAN 3: SPD BELAKANG (VISAS) -->
        <!-- ========================================== -->
    </div>
    <br clear=all style='page-break-before:always; mso-break-type:section-break'>
    <div class="Section3">

        <table id="page3table" class="border" style="font-size: 10pt; width: 100%; table-layout: fixed;">
            <colgroup>
                <col style="width: 5%;">
                <col style="width: 37%;">
                <col style="width: 58%;">
            </colgroup>

            <!-- I -->
            <tr>
                <td class="border center" style="vertical-align: top; width: 5%;"></td>
                <td class="border" style="width: 37%;"></td>
                <td class="border" style="padding: 2px 2px 2px 5px; vertical-align: top; width: 58%;">
                    <table style="width: 100%; border: none; font-size: 10pt; border-collapse: collapse;"
                        cellspacing="0" cellpadding="0">
                        <tr>
                            <td
                                style="width: 3%; white-space: nowrap; padding: 0px 0px 0px 5px; margin: 0px; mso-padding-alt: 0pt 0pt 0pt 5pt; vertical-align: top;">
                                I.</td>
                            <td
                                style="width: 42%; white-space: nowrap; padding: 0px 0px 0px 10px; margin: 0px; mso-padding-alt: 0pt 0pt 0pt 10pt; vertical-align: top;">
                                Berangkat dari</td>
                            <td style="width: 2%; vertical-align: top;">:</td>
                            <td style="width: 53%; vertical-align: top;">{{ $data['tempat_berangkat'] }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td
                                style="white-space: nowrap; padding: 0px 0px 0px 10px; mso-padding-alt: 0pt 0pt 0pt 10pt; vertical-align: top;">
                                (tempat kedudukan)</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td
                                style="padding: 0px 0px 0px 10px; mso-padding-alt: 0pt 0pt 0pt 10pt; vertical-align: top;">
                                Ke</td>
                            <td>:</td>
                            <td>{!! nl2br(e($data['tempat'])) !!}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td
                                style="padding: 0px 0px 0px 10px; mso-padding-alt: 0pt 0pt 0pt 10pt; vertical-align: top;">
                                Pada Tanggal</td>
                            <td>:</td>
                            <td>{{ $data['tgl_berangkat'] }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3"
                                style="padding: 0px 0px 0px 10px; margin: 0px; text-align: left; vertical-align: top; mso-padding-alt: 0pt 0pt 0pt 10pt; text-indent: 0px;">
                                Kepala Sub Bagian Umum,<br>Selaku Pejabat Pelaksana Teknis
                                Kegiatan<br>Sekretariat<br><br><br><br><span
                                    style="white-space: nowrap; font-size: 9pt; letter-spacing: -0.5px;">(NOVAN DEKA
                                    SETYA G, S.S.T.P., M.M)</span><br>NIP. 19901113 201507 1 001</td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- II, III, IV, V -->
            @foreach(['II', 'III', 'IV', 'V'] as $romawi)
                <tr>
                    <td class="border center" style="vertical-align: top; text-align: center;">{{ $romawi }}</td>
                    <td class="border" style="padding: 2px 2px 2px 5px; vertical-align: top;">Tiba :</td>
                    <td class="border" style="padding: 2px 2px 2px 5px; vertical-align: top;">Berangkat dari :</td>
                </tr>
                <tr>
                    <td class="border" style="vertical-align: top;"></td>
                    <td class="border" style="padding: 2px 2px 2px 5px; vertical-align: top;">Pada tanggal :</td>
                    <td class="border" style="padding: 2px 2px 2px 5px; vertical-align: top;">Pada tanggal :</td>
                </tr>
                <tr>
                    <td class="border" style="vertical-align: top;"></td>
                    <td class="border" style="padding: 2px 2px 2px 5px; vertical-align: top;">
                        <div>Kepala .......................................</div>
                        <br><br><br>
                        <div>(...................................................)</div>
                        <div>NIP.</div>
                    </td>
                    <td class="border" style="padding: 2px 2px 2px 5px; vertical-align: top;">
                        <div>Kepala .......................................</div>
                        <br><br><br>
                        <div>(...................................................)</div>
                        <div>NIP.</div>
                    </td>
                </tr>
            @endforeach

            <!-- VI -->
            <tr>
                <td class="border center" style="vertical-align: top; text-align: center;">VI</td>
                <td class="border" style="padding: 2px 2px 2px 5px; vertical-align: top; height: 1px;">Tiba : di
                    Karanganyar</td>
                <td rowspan="3" class="border justify" style="padding: 2px 2px 2px 5px; vertical-align: top;">
                    SPD telah diperiksa dengan keterangan bahwa perjalanan tersebut di atas benar dilakukan atas
                    perintah sesuai dengan kepentingan jabatan dan dilaksanakan dalam waktu yang
                    sesingkat-singkatnya.
                </td>
            </tr>
            <tr>
                <td class="border" style="vertical-align: top;"></td>
                <td class="border" style="padding: 2px 2px 2px 5px; vertical-align: top; height: 1px;">
                    Pada tanggal : {{ $data['tgl_kembali'] }}
                </td>
            </tr>
            <tr>
                <td class="border" style="vertical-align: top;"></td>
                <td class="border" style="padding: 2px 2px 2px 5px; vertical-align: top;">
                    <div>{!! $signatory['jabatan_head_page3'] !!}</div>
                    <br><br><br>
                    <div style="white-space: nowrap; font-size: 9pt; letter-spacing: -0.5px;">
                        ({{ $signatory['nama'] }})
                    </div>
                    <div>NIP. {{ $signatory['nip'] }}</div>
                </td>
            </tr>

            <!-- VII -->
            <tr>
                <td class="border center" style="text-align: center; vertical-align: top;">VII</td>
                <td colspan="2" class="border" style="padding: 2px 2px 2px 5px;">
                    Catatan Lain Lain
                </td>
            </tr>

            <!-- VIII -->
            <tr>
                <td class="border center" style="text-align: center; vertical-align: top;">VIII</td>
                <td colspan="2" class="border justify" style="padding: 2px 2px 2px 5px;">
                    <div>PERHATIAN :</div>
                    Pengguna anggaran/kuasa pengguna anggaran yang menerbitkan SPD, pejabat/pegawai/pihak lain yang
                    melakukan perjalanan dinas, pejabat yang mengesahkan tanggal berangkat/tiba, serta bendahara
                    pengeluaran bertanggung jawab berdasarkan peraturan-peraturan keuangan daerah apabila negara
                    menderita rugi akibat kesalahan, kelalaian, dan kealpaannya.
                </td>
            </tr>

        </table>
    </div>

</body>

</html>
