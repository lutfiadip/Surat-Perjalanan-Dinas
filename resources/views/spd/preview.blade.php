<style>
    .preview-section {
        background: #525659;
        padding: 15px;
        border-radius: 8px;
        height: calc(100vh - 40px);
        overflow-y: auto;
        overflow-x: auto;
        position: sticky;
        top: 20px;
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

<div class="preview-section">
    <h3 style="color: white; margin-top: 0; margin-bottom: 20px; text-align: center;">Live Preview (Halaman 1)
    </h3>

    <div class="paper">
        <!-- KOP SURAT PREVIEW -->
        <div
            style="display: flex; align-items: center; border-bottom: 1px solid #000; padding-bottom: 5px; margin-bottom: 10px;">
            <img src="{{ asset('img/logo.png') }}"
                style="width: 70px; height: auto; margin-right: 15px; margin-left: 20px;">
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
                <div style="width: 35%; text-align: right; padding-right: 5px;">Nomor :</div>
                <div style="flex: 1; text-align: left; padding-left: 5px;"><span id="preview-nomor">...</span>
                </div>
            </div>

            <div style="text-align: center; font-weight: normal; margin-bottom: 0px;">Kepala Badan Keuangan
                Daerah</div>

            <!-- BERDASARKAN -->
            <div style="display: flex; margin-bottom: 8px;">
                <div style="width: 100px; flex-shrink: 0;">Berdasarkan</div>
                <div style="width: 20px; text-align: center; font-weight: bold;">:</div>
                <div style="flex: 1;" id="preview-dasar-container">
                    ...
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
            <!-- SIGNATURE -->
            <div id="preview-signature-container"
                style="float: right; width: 310px; margin-top: 15px; text-align: left;">
            </div>

        </div>
    </div> <!-- End Page 1 Paper -->

    <h3 style="color: white; margin-top: 20px; margin-bottom: 20px; text-align: center;">Live Preview (Halaman 2)

    </h3>

    <div class="paper">
        <div
            style="display: flex; align-items: center; border-bottom: 1px solid #000; padding-bottom: 5px; margin-bottom: 10px;">
            <img src="{{ asset('img/logo.png') }}"
                style="width: 70px; height: auto; margin-right: 15px; margin-left: 20px;">
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
                    <td style="width: 90px; white-space: nowrap;">Lembar ke</td>
                    <td style="width: 10px;">:</td>
                    <td>............................................................</td>
                </tr>
                <tr>
                    <td>Kode No</td>
                    <td>:</td>
                    <td>............................................................</td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                    <td>............................................................</td>
                </tr>
            </table>
        </div>
        <div style="clear: both;"></div>

        <div style="text-align: center; text-decoration: underline; font-size: 11pt; margin-bottom: 8px;">
            SURAT PERJALANAN DINAS (SPD)</div>

        <table class="spd-table"
            style="table-layout: fixed; width: 100%; border-collapse: collapse; border: 1px solid black; font-size: 10pt;">
            <colgroup>
                <col style="width: 7%;">
                <col style="width: 37%;">
                <col style="width: 56%;">
            </colgroup>
            <tr>
                <td style="text-align: center; border: 1px solid black; padding: 5px; vertical-align: top;">1
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;">Pengguna Anggaran /
                    Kuasa Pengguna Anggaran
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;">
                    <span id="preview-spd-sign-nama">...</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; border: 1px solid black; padding: 5px; vertical-align: top;">2
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;">Nama /NIP Pegawai yang
                    Melaksanakan Perjalanan Dinas</td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;">
                    <div id="preview-spd-pegawai-nama">...</div>
                    <div id="preview-spd-pegawai-nip">...</div>
                </td>
            </tr>
            <!-- Row 3: Merged for Synchronization -->
            <!-- Row 3a: Pangkat -->
            <tr>
                <td rowspan="3" style="text-align: center; border: 1px solid black; padding: 5px; vertical-align: top;">
                    3</td>
                <td
                    style="border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; border-bottom: none; padding: 5px 5px 0 5px; vertical-align: top;">
                    <div style="display: flex;">
                        <div style="width: 20px;">a.</div>
                        <div>Pangkat dan Golongan</div>
                    </div>
                </td>
                <td
                    style="border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; border-bottom: none; padding: 5px 5px 0 5px; vertical-align: top;">
                    <div style="display: flex;">
                        <div style="width: 20px;">a.</div>
                        <div id="preview-spd-pegawai-pangkat">...</div>
                    </div>
                </td>
            </tr>
            <!-- Row 3b: Jabatan -->
            <tr>
                <td
                    style="border-left: 1px solid black; border-right: 1px solid black; border-top: none; border-bottom: none; padding: 0 5px 0 5px; vertical-align: top;">
                    <div style="display: flex;">
                        <div style="width: 20px;">b.</div>
                        <div>Jabatan / Instansi</div>
                    </div>
                </td>
                <td
                    style="border-left: 1px solid black; border-right: 1px solid black; border-top: none; border-bottom: none; padding: 0 5px 0 5px; vertical-align: top;">
                    <div style="display: flex;">
                        <div style="width: 20px;">b.</div>
                        <div id="preview-spd-pegawai-jabatan">...</div>
                    </div>
                </td>
            </tr>
            <!-- Row 3c: Biaya -->
            <tr>
                <td
                    style="border-left: 1px solid black; border-right: 1px solid black; border-top: none; border-bottom: 1px solid black; padding: 0 5px 5px 5px; vertical-align: top;">
                    <div style="display: flex;">
                        <div style="width: 20px;">c.</div>
                        <div>Tingkat Biaya Perjalanan Dinas</div>
                    </div>
                </td>
                <td
                    style="border-left: 1px solid black; border-right: 1px solid black; border-top: none; border-bottom: 1px solid black; padding: 0 5px 5px 5px; vertical-align: top;">
                    <div style="display: flex;">
                        <div style="width: 20px;">c.</div>
                        <div id="preview-spd-biaya">...</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; border: 1px solid black; padding: 5px; vertical-align: top;">4
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;">Maksud Perjalanan Dinas
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;"><span
                        id="preview-spd-maksud">...</span></td>
            </tr>
            <tr>
                <td style="text-align: center; border: 1px solid black; padding: 5px; vertical-align: top;">5
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;">Alat Angkut yang
                    Digunakan
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;"><span
                        id="preview-spd-alat">...</span></td>
            </tr>
            <tr>
                <td style="text-align: center; border: 1px solid black; padding: 5px; vertical-align: top;">6
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;">
                    a. Tempat Berangkat<br>
                    b. Tempat Tujuan
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;">
                    <div style="display: flex;">
                        <div style="width: 20px;">a.</div>
                        <div id="preview-spd-berangkat">...</div>
                    </div>
                    <div style="display: flex;">
                        <div style="width: 20px;">b.</div>
                        <div id="preview-spd-tujuan">...</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; border: 1px solid black; padding: 5px; vertical-align: top;">7
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;">
                    a. Lama Perjalanan Dinas<br>
                    b. Tanggal Berangkat<br>
                    c. Tanggal Harus Kembali
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;">
                    <div style="display: flex;">
                        <div style="width: 20px;">a.</div>
                        <div><span id="preview-spd-lama">...</span> hari</div>
                    </div>
                    <div style="display: flex;">
                        <div style="width: 20px;">b.</div>
                        <div id="preview-spd-tgl-berangkat">...</div>
                    </div>
                    <div style="display: flex;">
                        <div style="width: 20px;">c.</div>
                        <div id="preview-spd-tgl-kembali">...</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; border: 1px solid black; padding: 5px; vertical-align: top;">8
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;">Pengikut</td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;" id="preview-spd-pengikut-list">
                    <!-- JS WILL POPULATE THIS -->
                </td>
            </tr>

            <!-- ROW 9 -->
            <tr>
                <td style="text-align: center; border: 1px solid black; padding: 5px; vertical-align: top;">9
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;">
                    Pembebanan Anggaran<br>
                    a. SKPD<br>
                    b. Kode Rekening
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;">
                    <br>
                    <table style="width: 100%; border: none; border-collapse: collapse;">
                        <tr>
                            <td style="width: 20px; border: none; vertical-align: top; padding: 0;">a.</td>
                            <td style="border: none; vertical-align: top; padding: 0;">
                                <div id="preview-spd-skpd">...</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20px; border: none; vertical-align: top; padding: 0;">b.</td>
                            <td style="border: none; vertical-align: top; padding: 0;">
                                <div id="preview-spd-rekening">...</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td style="text-align: center; border: 1px solid black; padding: 5px; vertical-align: top;">10
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;">Keterangan Lain - Lain
                </td>
                <td style="border: 1px solid black; padding: 5px; vertical-align: top;">
                    <div id="preview-spd-ket">...</div>
                </td>
            </tr>
        </table>

        <div style="display: flex; margin-top: 20px; font-size: 10pt;">
            <div style="width: 50%;"></div>
            <div style="width: 50%;">
                <br>
                <div>Di keluarkan di Karanganyar</div>
                <div>Tanggal <span id="preview-spd-tgl-surat">...</span></div>
                <div>Pengguna Anggaran / Kuasa Pengguna Anggaran,</div>
                <br><br><br><br>
                <div>(<span id="preview-spd-sign-nama-2">...</span>)</div>
                <div>NIP. <span id="preview-spd-sign-nip-2">...</span></div>
            </div>
        </div>
    </div> <!-- End Page 2 SPD Paper -->

    <h3 style="color: white; margin-top: 20px; margin-bottom: 20px; text-align: center;">Live Preview (Halaman 3)

    </h3>

    <div class="paper" style="padding-bottom: 5mm; font-size: 10pt;">
        <table class="spd-table"
            style="table-layout: fixed; width: 100%; border-collapse: collapse; border: 1px solid black; font-size: 10pt;">
            <colgroup>
                <col style="width: 5%;">
                <col style="width: 37%;">
                <col style="width: 58%;">
            </colgroup>

            <!-- ROW I -->
            <tr>
                <td style="border: 1px solid black; vertical-align: top; padding: 5px; border-right: none;"></td>
                <td style="border: 1px solid black; vertical-align: top; padding: 5px; border-left: none;"></td>
                <td style="border: 1px solid black; vertical-align: top; padding: 5px;">
                    <table style="width: 100%; border: none;">
                        <tr>
                            <td style="width: 20px; vertical-align: top;">I.</td>
                            <td style="width: 115px; vertical-align: top;">Berangkat dari:</td>
                            <td style="vertical-align: top;" id="preview-visum-berangkat">...</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="vertical-align: top;">(tempat kedudukan)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="vertical-align: top;">Ke:</td>
                            <td style="vertical-align: top;" id="preview-visum-tujuan">...</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="vertical-align: top;">Pada Tanggal:</td>
                            <td style="vertical-align: top;" id="preview-visum-tgl-berangkat">...</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-top: 10px; vertical-align: top;">
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

            <!-- ROW II - V (Dynamic Loop) -->
            @foreach(['II', 'III', 'IV', 'V'] as $romawi)
                <tr>
                    <td style="text-align: center; border: 1px solid black; vertical-align: top; padding: 2px;">
                        {{ $romawi }}
                    </td>
                    <td style="border: 1px solid black; vertical-align: top; padding: 2px;">Tiba:</td>
                    <td style="border: 1px solid black; vertical-align: top; padding: 2px;">Berangkat dari:</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; vertical-align: top;"></td>
                    <td style="border: 1px solid black; vertical-align: top; padding: 2px;">Pada tanggal:</td>
                    <td style="border: 1px solid black; vertical-align: top; padding: 2px;">Pada tanggal:</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black; vertical-align: top;"></td>
                    <td style="border: 1px solid black; vertical-align: top; padding: 2px; height: 135px;">
                        <div style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>Kepala ......................</div>
                            <div>
                                <div style="font-size: 10pt; text-align: left;">
                                    (.............................................)
                                </div>
                                <div style="font-size: 10pt;">
                                    NIP.
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="border: 1px solid black; vertical-align: top; padding: 2px; height: 135px;">
                        <div style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                Kepala ......................
                            </div>
                            <div>
                                <div style="font-size: 10pt; text-align: left;">
                                    (.............................................)
                                </div>
                                <div style="font-size: 10pt;">
                                    NIP.
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

            <!-- ROW VI -->
            <tr>
                <td
                    style="border: 1px solid black; vertical-align: top; padding-left: 5px; text-align: center; padding: 2px;">
                    VI</td>
                <td style="border: 1px solid black; vertical-align: top; padding: 2px;">Tiba: di Karanganyar</td>
                <td rowspan="3" style="border: 1px solid black; vertical-align: top; padding: 5px; text-align: left;">
                    SPD telah diperiksa dengan keterangan bahwa perjalanan tersebut di atas benar dilakukan atas
                    perintah sesuai dengan kepentingan jabatan dan dilaksanakan dalam waktu yang
                    sesingkat-singkatnya.
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black; vertical-align: top;"></td>
                <td style="border: 1px solid black; vertical-align: top; padding: 2px;">
                    Pada tanggal: <span id="preview-visum-tgl-kembali">...</span>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid black; vertical-align: top;"></td>
                <td style="border: 1px solid black; vertical-align: top; padding: 2px; height: 100px;">
                    <div style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
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
                <td style="border: 1px solid black; vertical-align: top; padding-left: 5px; text-align: center;">VII
                </td>
                <td colspan="2" style="border: 1px solid black; vertical-align: top; padding: 2px 2px 2px 5px;">
                    Catatan Lain Lain
                </td>
            </tr>

            <!-- ROW VIII -->
            <tr>
                <td style="border: 1px solid black; vertical-align: top; padding-left: 5px; text-align: center;">VIII
                </td>
                <td colspan="2"
                    style="border: 1px solid black; vertical-align: top; padding: 2px 2px 2px 5px; text-align: left;">
                    <div>PERHATIAN :</div>
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