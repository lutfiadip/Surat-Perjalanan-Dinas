<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pegawaibkd_spd')->delete();
        DB::table('pegawaibkd_spd')->insert([
            ['nama' => 'PUJIYANTO, S.Sos, M.Si.', 'nip' => '197105151990031002', 'pangkat_gol' => 'Pembina Tk.I (IV/b)', 'jabatan' => 'Plt. Kepala Badan Keuangan Daerah'],
            ['nama' => 'NOVAN DEKA SETYA GARAGUNA, S.S.T.P., M.M.', 'nip' => '199011132015071001', 'pangkat_gol' => 'Penata (III/c)', 'jabatan' => 'Kepala Sub Bagian Umum'],
            ['nama' => 'DWI PURWANTI, S.E.', 'nip' => '197605251997032003', 'pangkat_gol' => 'Penata Tk.I (III/d)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bagian Umum'],
            ['nama' => 'TRI SURYANINGSIH, S.E., M.M.', 'nip' => '197810232010012012', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bagian Umum'],
            ['nama' => 'KUSUMASTUTI INDRIAMAYA, S.E.', 'nip' => '198403292006042008', 'pangkat_gol' => 'Penata Tk.I (III/d)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bagian Umum'],
            ['nama' => 'TRI WAHYUNI, S.Kom., M.M.', 'nip' => '198810052011012009', 'pangkat_gol' => 'Penata (III/c)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bagian Umum'],
            ['nama' => 'AGUNG NEHRUADI', 'nip' => '197311061998031005', 'pangkat_gol' => 'Penata Muda Tk.I (III/b)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bagian Umum'],
            ['nama' => 'RETNOWATI, A.Md.', 'nip' => '198203182010012025', 'pangkat_gol' => 'Penata (III/c)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bagian Umum'],
            ['nama' => 'WULAN FITRIANA SARI, S.E', 'nip' => '198705172011012016', 'pangkat_gol' => 'Penata Muda Tk.I (III/b)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bagian Umum'],
            ['nama' => 'SUMIDI', 'nip' => '197403212010011003', 'pangkat_gol' => 'Penata Muda (III/a)', 'jabatan' => 'Operator Layanan Operasional Pada Sub Bagian Umum'],
            ['nama' => 'DWIE HARY ANTONO', 'nip' => '197510272010011001', 'pangkat_gol' => 'Penata Muda (III/a)', 'jabatan' => 'Pengadministrasi Perkantoran Pada Sub Bagian Umum'],
            ['nama' => 'MARDIMAN', 'nip' => '196902092010011002', 'pangkat_gol' => 'Juru Tk.I (I/d)', 'jabatan' => 'Operator Layanan Operasional Pada Sub Bagian Umum'],
            ['nama' => 'ANGGI WULAN DARI, S.Kom.', 'nip' => '199707172025052001', 'pangkat_gol' => 'CPNS (III/a)', 'jabatan' => 'Penata Kelola Sistem dan Teknologi Informasi Pada Sub Bagian Umum'],
            ['nama' => 'SAIFUL RAJIB SUMINAR, A.Md.', 'nip' => '199003162025051001', 'pangkat_gol' => 'CPNS (II/c)', 'jabatan' => 'Arsiparis Terampil Pada Sub Bagian Umum'],
            ['nama' => 'ZULAIHAH NUR AINI, A.Md.', 'nip' => '199602152025052001', 'pangkat_gol' => 'CPNS (II/c)', 'jabatan' => 'Pranata Komputer Terampil Pada Sub Bagian Umum'],
            ['nama' => 'NOVITA LISTIYOWATI, A.Md. Bns', 'nip' => '200108232025052003', 'pangkat_gol' => 'CPNS (II/c)', 'jabatan' => 'Penata Laksana Barang Terampil Pada Sub Bagian Umum'],
            ['nama' => 'AFIYAN DUDDY GUNTUR PRADANA', 'nip' => '199803142025211015', 'pangkat_gol' => 'PPPK ( V )', 'jabatan' => 'Operator Layanan Operasional'],
            ['nama' => 'THOMAS ADI PAMUNGKAS', 'nip' => '200006122025211006', 'pangkat_gol' => 'PPPK ( V )', 'jabatan' => 'Operator Layanan Operasional'],
            ['nama' => 'EKO SETIYARSO, S.E., M.M.', 'nip' => '197002081991031004', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Kabid. Pendataan, Pengolahan Dan Penetapan'],
            ['nama' => 'SRI HANTO, S.H., M.Si.', 'nip' => '197804201997031002', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Kasubbid. Pengolahan Data, Intensifikasi dan Ekstensifikasi'],
            ['nama' => 'TITIK ENDAH UTARI, S.Sos., M.M', 'nip' => '197804121997032003', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Kasubbid. Pendaftaran dan Pendataan'],
            ['nama' => 'ANDU AGUNG PURWANDONO, S.E., M.M.', 'nip' => '198005182003121006', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Analis Kebijakan Ahli Muda'],
            ['nama' => 'WALUYA, S.E, M.M', 'nip' => '197605122011011005', 'pangkat_gol' => 'Penata Muda Tk.I (III/b)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Pengolahan Data, Intensifikasi dan Ekstensifikasi'],
            ['nama' => 'GALUH KURNIAWAN, S.E., M.M', 'nip' => '198410232010011021', 'pangkat_gol' => 'Penata (III/c)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Pendaftaran dan Pendataan'],
            ['nama' => 'ANDHI SARWOKO, S.E', 'nip' => '198803012011011007', 'pangkat_gol' => 'Penata Muda Tk.I (III/b)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Pendaftaran dan Pendataan'],
            ['nama' => 'HERDIYANA CATUR N., S.E', 'nip' => '198805022011012024', 'pangkat_gol' => 'Penata Muda Tk.I (III/b)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Pendaftaran dan Pendataan'],
            ['nama' => 'YUSUB MARDIYANTO', 'nip' => '197606092010011003', 'pangkat_gol' => 'Penata Muda (III/a)', 'jabatan' => 'Pengolah Data dan Informasi Pada Sub Bidang Pendaftaran dan Pendataan'],
            ['nama' => 'SRIYANI', 'nip' => '197709162010012002', 'pangkat_gol' => 'Penata Muda (III/a)', 'jabatan' => 'Pengolah Data dan Informasi Pada Sub Bidang Pendaftaran dan Pendataan'],
            ['nama' => 'PUTIAWAN', 'nip' => '197910032010011002', 'pangkat_gol' => 'Penata Muda (III/a)', 'jabatan' => 'Pengolah Data, Intensifikasi dan Ekstensifikasi'],
            ['nama' => 'ARDIANTO, S.S.T.P., M.M.', 'nip' => '198208212001121002', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Kabid. Penagihan, Keberatan dan Pemeriksaan Pajak'],
            ['nama' => 'HERY SETIAWAN, S.Pd., M.I.Kom.', 'nip' => '197905112010011020', 'pangkat_gol' => 'Penata Tingkat I (III/d)', 'jabatan' => 'Kasubbid. Penagihan'],
            ['nama' => 'RATNA FATMAWATI, S.E, M.Si, Ak', 'nip' => '197910152008042002', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Kepala Sub Bidang Keberatan Dan Banding'],
            ['nama' => 'SRI PARINI, S.E.', 'nip' => '196911241993032007', 'pangkat_gol' => 'Penata Tk.I (III/d)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Penagihan'],
            ['nama' => 'ENY DWI SULISTIANINGSIH, S.E.', 'nip' => '197808152003122013', 'pangkat_gol' => 'Penata Tk.I (III/d)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Penagihan'],
            ['nama' => 'DIEMAS PERDANA KUSUMA, S.H', 'nip' => '198311082011011006', 'pangkat_gol' => 'Penata Tk.I (III/d)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Keberatan dan Banding'],
            ['nama' => 'RIRIN IKASARI, S.E., M.M', 'nip' => '198607242010012038', 'pangkat_gol' => 'Penata (III/c)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Keberatan dan Banding'],
            ['nama' => 'NURIYATI, A.Md.', 'nip' => '198410192011012013', 'pangkat_gol' => 'Penata Muda Tk.I (III/b)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Keberatan dan Banding'],
            ['nama' => 'TRI HARTANTO, S.Ak.', 'nip' => '198305272010011002', 'pangkat_gol' => 'Penata Muda (III/a)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Keberatan dan Banding'],
            ['nama' => 'HERU SRI KUNCORO, S.Ak.', 'nip' => '', 'pangkat_gol' => 'Penata Muda (III/a)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Penagihan dan Banding'],
            ['nama' => 'SUWONO', 'nip' => '196912042007011015', 'pangkat_gol' => 'Pengatur Tk.I (II/d)', 'jabatan' => 'Pengolah Data dan Informasi Pada Sub Bidang Penagihan'],
            ['nama' => 'AGUNG JOKO WIYARSO, S.S.T.P., M.M.', 'nip' => '197808191997111001', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Kabid. Anggaran'],
            ['nama' => 'YOGA PRADITYA, S.E., M.M', 'nip' => '198811282011011003', 'pangkat_gol' => 'Penata Muda Tk.I (III/b)', 'jabatan' => 'Kasubbid. Pengendalian Anggaran'],
            ['nama' => 'WAHYU SETYO UTOMO, S.M.', 'nip' => '197411031998031003', 'pangkat_gol' => 'Penata Tk.I (III/d)', 'jabatan' => 'Kasubid. Perencanaan dan Penyusunan Anggaran'],
            ['nama' => 'CLOUDIA DEWANTIN, S.I.P., M.M.', 'nip' => '197110181996032004', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Pengendalian Anggaran'],
            ['nama' => 'ADITYA WIDHI NUGROHO, S.E.', 'nip' => '199006252025051002', 'pangkat_gol' => 'CPNS (III/a)', 'jabatan' => 'Analis Keuangan Pusat dan Daerah Ahli Pertama'],
            ['nama' => 'TRIAS MURTI, S.E., M.M.', 'nip' => '197608212003122006', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Kabid. Perbendaharaan dan Kas Daerah'],
            ['nama' => 'JOKO HADIYANTO, A.Md.', 'nip' => '198006072009021005', 'pangkat_gol' => 'Penata (III/c)', 'jabatan' => 'Kasubbid. Perbendaharaan'],
            ['nama' => 'WAHYU WIDIYATMI, S.Kom.', 'nip' => '197309141994012001', 'pangkat_gol' => 'Penata Tk.I (III/d)', 'jabatan' => 'Kasubbid. Kas Daerah'],
            ['nama' => 'SITI LESTARI, S.Sos., M.M', 'nip' => '197111161997032002', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Kas Daerah'],
            ['nama' => 'ADIK ENDIRA NARISWARI, S.E., M.M.', 'nip' => '197402021996062001', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Perbendaharaan'],
            ['nama' => 'SARI DEWI PRASETYANINGRUM, S.E.', 'nip' => '198001202006042002', 'pangkat_gol' => 'Penata Tk.I (III/d)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Perbendaharaan'],
            ['nama' => 'RACHMAT YUWONO NUGROHO, S.E', 'nip' => '198005242009031003', 'pangkat_gol' => 'Penata Tingkat I (III/d)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Kas Daerah'],
            ['nama' => 'HARTONO', 'nip' => '197905132008011025', 'pangkat_gol' => 'Penata Muda (III/a)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Perbendaharaan'],
            ['nama' => 'ETI WIJAYANTI, S.E.', 'nip' => '199408212025052001', 'pangkat_gol' => 'CPNS (III/a)', 'jabatan' => 'Analis Keuangan Pusat dan Daerah Ahli Pertama'],
            ['nama' => 'HAPSARI SEKARTAJI, S.Sos., M.M.', 'nip' => '198105092005012011', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Kabid. Akuntansi'],
            ['nama' => 'WAHYU ISKANDAR WIDYOBROTO, S.E.', 'nip' => '197307252006041008', 'pangkat_gol' => 'Penata Tk.I (III/d)', 'jabatan' => 'Kasubbid. Pembukuan, Pelaporan dan Informasi Keuangan'],
            ['nama' => 'JUNIARDI ANDY MARWINDIO, S.E.', 'nip' => '197606212005011010', 'pangkat_gol' => 'Penata Tk.I (III/d)', 'jabatan' => 'Kasubbid. Pengolahan dan Pertanggungjawaban Keuangan'],
            ['nama' => 'IKA WULANDARI, S.E., M.Ak', 'nip' => '198307272009022010', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Pembukuan, Pelaporan dan Informasi Keuangan'],
            ['nama' => 'APRILIA RAHMANINGTYAS, S.E.', 'nip' => '198404282011012008', 'pangkat_gol' => 'Penata Muda Tk.I (III/b)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Pengelolaan dan Pertanggungjawaban'],
            ['nama' => 'ETITIA SULARNO, S.E.', 'nip' => '198504282009022006', 'pangkat_gol' => 'Penata (III/c)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Pembukuan, Pelaporan dan Informasi Keuangan'],
            ['nama' => 'TITIK PURWATI, S.E., M.M.', 'nip' => '197808081998032006', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Kabid. Aset Daerah'],
            ['nama' => 'EKO AGUS SANTOSO, S.Kom., M.Si.', 'nip' => '197708032005011008', 'pangkat_gol' => 'Penata Tk.I (III/d)', 'jabatan' => 'Kasubbid. Pemanfaatan dan Pengamanan Aset Daerah'],
            ['nama' => 'SUBHAH DWI HANDAYANI, S.E., M.M.', 'nip' => '197807081999032003', 'pangkat_gol' => 'Pembina (IV/a)', 'jabatan' => 'Kasubbid. Pendataan Aset Daerah'],
            ['nama' => 'SISWANTO, S.Kom.', 'nip' => '197908182010011020', 'pangkat_gol' => 'Penata Tk.I (III/d)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Pendataan Aset Daerah'],
            ['nama' => 'AGUS SUKAMTO, S.Kom', 'nip' => '197504032010011013', 'pangkat_gol' => 'Penata Tk.I (III/d)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Pendataan Aset Daerah'],
            ['nama' => 'MARGIYANTO, S.E.', 'nip' => '198104132006041008', 'pangkat_gol' => 'Penata (III/c)', 'jabatan' => 'Penelaah Teknis Kebijakan Pada Sub Bidang Pendataan Aset Daerah'],
            ['nama' => 'ENNY SISWATININGSIH, A.Md.', 'nip' => '198101062010012022', 'pangkat_gol' => 'Penata (III/c)', 'jabatan' => 'Pengolah Data dan Informasi Pada Sub Bidang Pendataan Aset Daerah'],
            ['nama' => 'WAHYU DWI NUGROHO, A.Md.', 'nip' => '198103202010011014', 'pangkat_gol' => 'Penata Muda (III/a)', 'jabatan' => 'Pengolah Data dan Informasi Pada Sub Bidang Pemanfaatan dan Pengamanan Aset Daerah'],
        ]);
    }
}
