<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('spd', function (Blueprint $table) {
            if (!Schema::hasColumn('spd', 'tanggal_surat')) {
                $table->date('tanggal_surat')->nullable()->after('nomor_surat');
            }
            if (!Schema::hasColumn('spd', 'tahun_anggaran')) {
                $table->year('tahun_anggaran')->nullable()->after('tanggal_surat');
            }
            if (!Schema::hasColumn('spd', 'dasar_surat')) {
                $table->text('dasar_surat')->nullable()->after('tahun_anggaran');
            }
            if (!Schema::hasColumn('spd', 'maksud')) {
                $table->text('maksud')->nullable()->after('dasar_surat');
            }
            if (!Schema::hasColumn('spd', 'hari')) {
                $table->string('hari')->nullable()->after('maksud');
            }
            if (!Schema::hasColumn('spd', 'tanggal_kegiatan')) {
                $table->date('tanggal_kegiatan')->nullable()->after('hari');
            }
            if (!Schema::hasColumn('spd', 'tempat')) {
                $table->text('tempat')->nullable()->after('tanggal_kegiatan');
            }
            if (!Schema::hasColumn('spd', 'tingkat_biaya')) {
                $table->string('tingkat_biaya')->nullable()->after('tempat');
            }
            if (!Schema::hasColumn('spd', 'alat_angkut')) {
                $table->string('alat_angkut')->nullable()->after('tingkat_biaya');
            }
            if (!Schema::hasColumn('spd', 'lama_perjalanan')) {
                $table->integer('lama_perjalanan')->nullable()->after('alat_angkut');
            }
            if (!Schema::hasColumn('spd', 'tempat_berangkat')) {
                $table->string('tempat_berangkat')->nullable()->after('lama_perjalanan');
            }
            if (!Schema::hasColumn('spd', 'tgl_berangkat')) {
                $table->date('tgl_berangkat')->nullable()->after('tempat_berangkat');
            }
            if (!Schema::hasColumn('spd', 'tgl_kembali')) {
                $table->date('tgl_kembali')->nullable()->after('tgl_berangkat');
            }
            if (!Schema::hasColumn('spd', 'anggaran_skpd')) {
                $table->string('anggaran_skpd')->nullable()->after('tgl_kembali');
            }
            if (!Schema::hasColumn('spd', 'kode_rekening')) {
                $table->string('kode_rekening')->nullable()->after('anggaran_skpd');
            }
            if (!Schema::hasColumn('spd', 'keterangan_lain')) {
                $table->text('keterangan_lain')->nullable()->after('kode_rekening');
            }
            if (!Schema::hasColumn('spd', 'penandatangan')) {
                $table->string('penandatangan')->nullable()->after('keterangan_lain');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spd', function (Blueprint $table) {
            $columns = [
                'tanggal_surat',
                'tahun_anggaran',
                'dasar_surat',
                'maksud',
                'hari',
                'tanggal_kegiatan',
                'tempat',
                'tingkat_biaya',
                'alat_angkut',
                'lama_perjalanan',
                'tempat_berangkat',
                'tgl_berangkat',
                'tgl_kembali',
                'anggaran_skpd',
                'kode_rekening',
                'keterangan_lain',
                'penandatangan'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('spd', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
