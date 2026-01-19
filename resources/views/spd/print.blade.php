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

        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            line-height: 1.2;
            color: #000;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 15mm 20mm;
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
            width: 150px;
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
            text-align: justify;
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
            text-align: justify;
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

            body,
            html {
                width: 100%;
                height: auto;
            }

            .page {
                width: 210mm;
                height: auto;
                min-height: 0;
                margin: 0;
                padding: 15mm 20mm;
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

        <div style="padding-left: 30px;">
            <div class="title-surat">SURAT TUGAS</div>
            <div style="display: flex; margin-bottom: 15px; font-weight: bold;">
                <div style="width: 40%; text-align: right; padding-right: 5px;">Nomor :</div>
                <div style="flex: 1; text-align: left; padding-left: 5px;">{{ $data['nomor_surat'] }}</div>
            </div>

            <div style="text-align: center; font-weight: normal; margin-bottom: 0px;">Kepala Badan Keuangan Daerah</div>

            <div class="section-row">
                <div class="label-col" style="width: 100px;">Berdasarkan</div>
                <div class="colon-col">:</div>
                <div class="value-col">
                    <div style="text-align: justify; text-align-last: justify;">
                        {!! str_replace('Nomor:', '</div><div style="text-align: justify; text-align-last: left;">Nomor:', $data['dasar_surat']) !!}
                    </div>
                </div>
            </div>

            <div style="text-align: center; margin: 10px 0;">memberikan perintah</div>

            <div class="section-row">
                <div class="label-col" style="width: 60px;">Kepada</div>
                <div class="colon-col">:</div>
                <div class="value-col">
                    @foreach($selectedPegawais as $index => $pegawai)
                        <div class="kepada-list-item">
                            <div class="kepada-num">{{ $index + 1 }}.</div>
                            <div class="kepada-content">
                                <div class="kepada-row">
                                    <div class="k-label">Nama</div>
                                    <div class="k-colon">:</div>
                                    <div class="k-val">{{ $pegawai->nama }}</div>
                                </div>
                                <div class="kepada-row">
                                    <div class="k-label">Pangkat / Gol</div>
                                    <div class="k-colon">:</div>
                                    <div class="k-val">{{ $pegawai->pangkat_gol }}</div>
                                </div>
                                <div class="kepada-row">
                                    <div class="k-label">NIP</div>
                                    <div class="k-colon">:</div>
                                    <div class="k-val">{{ $pegawai->nip }}</div>
                                </div>
                                <div class="kepada-row">
                                    <div class="k-label">Jabatan</div>
                                    <div class="k-colon">:</div>
                                    <div class="k-val" style="text-align: left;">{{ $pegawai->jabatan }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="section-row">
                <div class="label-col" style="width: 60px;">Untuk</div>
                <div class="colon-col">:</div>
                <div class="value-col">
                    <div class="untuk-item">
                        <div class="kepada-num">1.</div>
                        <div class="kepada-content">
                            {{ $data['maksud'] }}, yang diselenggarakan pada:<br>
                            <div class="disk-row">
                                <div class="k-label">Hari</div>
                                <div class="k-colon">:</div>
                                <div class="k-val">{{ $data['hari'] }}</div>
                            </div>
                            <div class="disk-row">
                                <div class="k-label">Tanggal</div>
                                <div class="k-colon">:</div>
                                <div class="k-val">{{ $data['tanggal_kegiatan'] }}</div>
                            </div>
                            <div class="disk-row">
                                <div class="k-label">Tempat</div>
                                <div class="k-colon">:</div>
                                <div class="k-val">{!! nl2br(e($data['tempat'])) !!}</div>
                            </div>
                        </div>
                    </div>
                    <div style="height: 15px;"></div>
                    <div class="untuk-item">
                        <div class="kepada-num">2.</div>
                        <div class="kepada-content">Melaporkan hasil tugas kepada pejabat yang bersangkutan.</div>
                    </div>
                    <div class="untuk-item">
                        <div class="kepada-num">3.</div>
                        <div class="kepada-content">Dengan diterbitkannya Surat Perintah Tugas ini, maka segala biaya
                            yang
                            timbul dibebankan pada APBD Kabupaten Karanganyar Tahun Anggaran {{ date('Y') }}.</div>
                    </div>
                </div>
            </div>

            <div class="signature-container">
                <div style="margin-bottom: 20mm;">
                    {!! $signatory['full_signature_page1'] !!}
                </div>
            </div>
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

        <div style="padding-left: 30px;">
            <!-- LEMBAR INFO BLOCK (Centered) -->
            <div
                style="display: flex; justify-content: flex-end; margin-bottom: 10px; padding-right: 20px; margin-top: 20px;">
                <table style="font-size: 10pt; border: none; text-align: left;">
                    <tr>
                        <td style="border: none; padding: 1px 10px;">Lembar ke</td>
                        <td style="border: none; padding: 1px;">:</td>
                        <td style="border: none; padding: 1px;">
                            ............................................................
                        </td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 1px 10px;">Kode No</td>
                        <td style="border: none; padding: 1px;">:</td>
                        <td style="border: none; padding: 1px;">
                            ............................................................
                        </td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 1px 10px;">Nomor</td>
                        <td style="border: none; padding: 1px;">:</td>
                        <td style="border: none; padding: 1px;">
                            ............................................................
                        </td>
                    </tr>
                </table>
            </div>

            <div
                style="text-align: center; font-weight: normal; text-decoration: underline; font-size: 11pt; margin-bottom: 8px;">
                SURAT PERJALANAN DINAS (SPD)</div>

            <table class="spd-table" style="table-layout: fixed; width: 100%;">
                <colgroup>
                    <col style="width: 5%;">
                    <col style="width: 35%;">
                    <col style="width: 60%;">
                </colgroup>
                <tr>
                    <td
                        style="text-align: center; vertical-align: top; border: 1px solid black; padding: 5px; width: 5%;">
                        1
                    </td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px; width: 35%;">Pengguna
                        Anggaran /
                        Kuasa Pengguna Anggaran</td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px; width: 60%;">
                        {{ $signatory['nama'] }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; vertical-align: top; border: 1px solid black; padding: 5px;">2</td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px;">Nama /NIP Pegawai yang
                        Melaksanakan Perjalanan Dinas</td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px;">
                        {{ $selectedPegawais->first()->nama }}<br>
                        {{ $selectedPegawais->first()->nip }}
                    </td>
                </tr>
                <!-- Row 3a: Pangkat -->
                <tr>
                    <td rowspan="3"
                        style="text-align: center; vertical-align: top; border: 1px solid black; padding: 5px;">3</td>
                    <td
                        style="vertical-align: top; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; border-bottom: none; padding: 5px 5px 0 5px;">
                        <table style="width: 100%; border: none; border-collapse: collapse;">
                            <tr>
                                <td style="width: 20px; border: none; vertical-align: top; padding: 0;">a.</td>
                                <td style="border: none; vertical-align: top; padding: 0;">Pangkat dan Golongan</td>
                            </tr>
                        </table>
                    </td>
                    <td
                        style="vertical-align: top; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; border-bottom: none; padding: 5px 5px 0 5px;">
                        <table style="width: 100%; border: none; border-collapse: collapse;">
                            <tr>
                                <td style="width: 20px; border: none; vertical-align: top; padding: 0;">a.</td>
                                <td style="border: none; vertical-align: top; padding: 0;">
                                    {{ $selectedPegawais->first()->pangkat_gol }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Row 3b: Jabatan (Syncs height if wrapped) -->
                <tr>
                    <td
                        style="vertical-align: top; border-left: 1px solid black; border-right: 1px solid black; border-top: none; border-bottom: none; padding: 0 5px 0 5px;">
                        <table style="width: 100%; border: none; border-collapse: collapse;">
                            <tr>
                                <td style="width: 20px; border: none; vertical-align: top; padding: 0;">b.</td>
                                <td style="border: none; vertical-align: top; padding: 0;">Jabatan / Instansi</td>
                            </tr>
                        </table>
                    </td>
                    <td
                        style="vertical-align: top; border-left: 1px solid black; border-right: 1px solid black; border-top: none; border-bottom: none; padding: 0 5px 0 5px;">
                        <table style="width: 100%; border: none; border-collapse: collapse;">
                            <tr>
                                <td style="width: 20px; border: none; vertical-align: top; padding: 0;">b.</td>
                                <td style="border: none; vertical-align: top; padding: 0;">
                                    {{ $selectedPegawais->first()->jabatan }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Row 3c: Tingkat Biaya -->
                <tr>
                    <td
                        style="vertical-align: top; border-left: 1px solid black; border-right: 1px solid black; border-top: none; border-bottom: 1px solid black; padding: 0 5px 5px 5px;">
                        <table style="width: 100%; border: none; border-collapse: collapse;">
                            <tr>
                                <td style="width: 20px; border: none; vertical-align: top; padding: 0;">c.</td>
                                <td style="border: none; vertical-align: top; padding: 0;">Tingkat Biaya Perjalanan
                                    Dinas</td>
                            </tr>
                        </table>
                    </td>
                    <td
                        style="vertical-align: top; border-left: 1px solid black; border-right: 1px solid black; border-top: none; border-bottom: 1px solid black; padding: 0 5px 5px 5px;">
                        <table style="width: 100%; border: none; border-collapse: collapse;">
                            <tr>
                                <td style="width: 20px; border: none; vertical-align: top; padding: 0;">c.</td>
                                <td style="border: none; vertical-align: top; padding: 0;">
                                    {{ $data['tingkat_biaya'] ?? '' }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; vertical-align: top; border: 1px solid black; padding: 5px;">4</td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px;">Maksud Perjalanan Dinas</td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px;">{{ $data['maksud'] }}</td>
                </tr>
                <tr>
                    <td style="text-align: center; vertical-align: top; border: 1px solid black; padding: 5px;">5</td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px;">Alat Angkut yang Digunakan
                    </td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px;">{{ $data['alat_angkut'] }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; vertical-align: top; border: 1px solid black; padding: 5px;">6</td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px;">
                        a. Tempat Berangkat<br>
                        b. Tempat Tujuan
                    </td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px;">
                        <table style="width: 100%; border: none; border-collapse: collapse; margin: 0; padding: 0;">
                            <tr>
                                <td style="width: 20px; border: none; padding: 0; vertical-align: top;">a.</td>
                                <td style="border: none; padding: 0; vertical-align: top;">
                                    {{ $data['tempat_berangkat'] }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20px; border: none; padding: 0; vertical-align: top;">b.</td>
                                <td style="border: none; padding: 0; vertical-align: top;">
                                    {!! nl2br(e($data['tempat'])) !!}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; vertical-align: top; border: 1px solid black; padding: 5px;">7</td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px;">
                        a. Lama Perjalanan Dinas<br>
                        b. Tanggal Berangkat<br>
                        c. Tanggal Harus Kembali
                    </td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px;">
                        <table style="width: 100%; border: none; border-collapse: collapse; margin: 0; padding: 0;">
                            <tr>
                                <td style="width: 20px; border: none; padding: 0; vertical-align: top;">a.</td>
                                <td style="border: none; padding: 0; vertical-align: top;">
                                    {{ $data['lama_perjalanan'] }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20px; border: none; padding: 0; vertical-align: top;">b.</td>
                                <td style="border: none; padding: 0; vertical-align: top;">{{ $data['tgl_berangkat'] }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20px; border: none; padding: 0; vertical-align: top;">c.</td>
                                <td style="border: none; padding: 0; vertical-align: top;">{{ $data['tgl_kembali'] }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; vertical-align: top; border: 1px solid black; padding: 5px;">8</td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px;">Pengikut</td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px;">
                        @if($selectedPegawais->count() > 1)
                            <table style="width: 100%; border: none; border-collapse: collapse; margin: 0; padding: 0;">
                                @foreach($selectedPegawais->slice(1) as $index => $pengikut)
                                    <tr>
                                        <td style="width: 20px; border: none; padding: 0; vertical-align: top;">
                                            {{ $loop->iteration }}.
                                        </td>
                                        <td style="border: none; padding: 0; vertical-align: top;">{{ $pengikut->nama }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else

                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; vertical-align: top; border: 1px solid black; padding: 5px;">9</td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px;">
                        Pembebanan Anggaran<br>
                        a. SKPD<br>
                        b. Kode Rekening
                    </td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px;">
                        <br>
                        <table style="width: 100%; border: none; border-collapse: collapse; margin: 0; padding: 0;">
                            <tr>
                                <td style="width: 20px; border: none; padding: 0; vertical-align: top;">a.</td>
                                <td style="border: none; padding: 0; vertical-align: top;">{{ $data['anggaran_skpd'] }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20px; border: none; padding: 0; vertical-align: top;">b.</td>
                                <td style="border: none; padding: 0; vertical-align: top;">
                                    {{ $data['kode_rekening'] ?? '' }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; vertical-align: top; border: 1px solid black; padding: 5px;">10</td>
                    <td style="vertical-align: top; border: 1px solid black; padding: 5px;">Keterangan Lain - Lain
                    </td>
                    <td
                        style="vertical-align: top; border: 1px solid black; padding: 5px; word-wrap: break-word; word-break: break-all;">
                        {!! nl2br(e($data['keterangan_lain'] ?? '')) !!}
                    </td>
                </tr>
            </table>

            <div class="signature-container" style="margin-top: 30px;">
                <div>Di keluarkan di Karanganyar</div>
                <div style="margin-bottom: 20mm;">
                    Tanggal {{ $data['tanggal_surat'] }}<br>
                    Pengguna Anggaran / Kuasa Pengguna Anggaran,
                </div>
                <div>({{ $signatory['nama'] }})</div>
                <div>NIP. {{ $signatory['nip'] }}</div>
            </div>
        </div>
    </div>

    <!-- HALAMAN 3: VISAS -->
    <div class="page"
        style="page-break-before: always; font-family: Arial, Helvetica, sans-serif; padding: 1.27cm 1.0cm 0.3cm 2.0cm;">
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
                            <td style="width: 3%; vertical-align: top; white-space: nowrap; padding-left: 5px;">I.</td>
                            <td style="width: 42%; vertical-align: top; white-space: nowrap; padding-left: 10px;">
                                Berangkat dari</td>
                            <td style="width: 2%; vertical-align: top;">:</td>
                            <td style="width: 53%; vertical-align: top; white-space: nowrap;">
                                {{ $data['tempat_berangkat'] }}
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="vertical-align: top; white-space: nowrap; padding-left: 10px;">(tempat kedudukan)
                            </td>
                            <td style="vertical-align: top;"></td>
                            <td style="vertical-align: top;"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="vertical-align: top; padding-left: 10px;">Ke</td>
                            <td style="vertical-align: top;">:</td>
                            <td style="vertical-align: top;">{!! nl2br(e($data['tempat'])) !!}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="vertical-align: top; padding-left: 10px;">Pada Tanggal</td>
                            <td style="vertical-align: top;">:</td>
                            <td style="vertical-align: top;">{{ $data['tgl_berangkat'] }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="3" style="padding-left: 10px; vertical-align: top;">
                                <div>Kepala Sub Bagian Umum,</div>
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

            <!-- ROW II, III, IV, V -->
            @foreach(['II', 'III', 'IV', 'V'] as $romawi)
                <tr>
                    <td rowspan="3" style="border: 1px solid black; vertical-align: top; padding: 1px; text-align: center;">
                        {{ $romawi }}
                    </td>
                    <td style="border: 1px solid black; vertical-align: top; padding: 2px 2px 2px 5px;">Tiba :</td>
                    <td style="border: 1px solid black; vertical-align: top; padding: 2px 2px 2px 5px;">Berangkat dari :
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; vertical-align: top; padding: 2px 2px 2px 5px;">Pada tanggal :</td>
                    <td style="border: 1px solid black; vertical-align: top; padding: 2px 2px 2px 5px;">Pada tanggal :</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; vertical-align: top; padding: 2px 2px 2px 5px; height: 88px;">
                        <div style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>Kepala .......................................</div>
                            <div>
                                <div>(...................................................)</div>
                                <div>NIP.</div>
                            </div>
                        </div>
                    </td>
                    <td style="border: 1px solid black; vertical-align: top; padding: 2px 2px 2px 5px; height: 88px;">
                        <div style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>Kepala .......................................</div>
                            <div>
                                <div>(...................................................)</div>
                                <div>NIP.</div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

            <!-- ROW VI -->
            <tr>
                <td rowspan="3" style="border: 1px solid black; vertical-align: top; padding-left: 5px;">
                    VI</td>
                <td style="border: 1px solid black; vertical-align: top; padding: 2px 2px 2px 5px; height: 1px;">Tiba :
                    di
                    Karanganyar</td>
                <td rowspan="3"
                    style="border: 1px solid black; vertical-align: top; padding: 2px 2px 2px 5px; text-align: justify;">
                    SPD telah diperiksa dengan keterangan bahwa perjalanan tersebut di atas benar dilakukan atas
                    perintah sesuai dengan kepentingan jabatan dan dilaksanakan dalam waktu yang sesingkat-singkatnya.
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black; vertical-align: top; padding: 2px 2px 2px 5px; height: 1px;">
                    Pada tanggal : {{ $data['tgl_kembali'] }}
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black; vertical-align: top; padding: 2px 2px 2px 5px; height: 88px;">
                    <div style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>{!! $signatory['jabatan_head_page3'] !!}</div>
                        <div>
                            <div style="white-space: nowrap; font-size: 9pt; letter-spacing: -0.5px;">
                                ({{ $signatory['nama'] }})
                            </div>
                            <div>NIP. {{ $signatory['nip'] }}</div>
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
                    Pengguna anggaran/kuasa pengguna anggaran yang menerbitkan SPD, pejabat/pegawai/pihak lain yang
                    melakukan perjalanan dinas, pejabat yang mengesahkan tanggal berangkat/tiba, serta bendahara
                    pengeluaran bertanggung jawab berdasarkan peraturan-peraturan keuangan daerah apabila negara
                    menderita rugi akibat kesalahan, kelalaian, dan kealpaannya.
                </td>
            </tr>

        </table>

    </div>

    <script>
        window.print();
    </script>
</body>

</html>