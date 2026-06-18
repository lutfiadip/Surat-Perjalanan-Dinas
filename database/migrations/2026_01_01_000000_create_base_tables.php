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
        // 1. Tabel pegawaibkd_spd (Tanpa unit_kerja & status_aktif karena ditambahkan di migrasi terpisah)
        Schema::create('pegawaibkd_spd', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('pangkat_gol', 50)->nullable();
            $table->string('nip', 20)->nullable();
            $table->string('jabatan', 100);
        });

        // 2. Tabel penandatangan (Ditambahkan timestamps, tanpa pangkat, jenis & variant_ttd karena ditambahkan di migrasi terpisah)
        Schema::create('penandatangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip', 20)->nullable();
            $table->string('jabatan', 100);
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });

        // 3. Tabel spd (Hanya kolom dasar, detail ditambahkan di migrasi terpisah)
        Schema::create('spd', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat_tugas')->nullable();
            $table->enum('status', ['draft', 'final'])->default('draft');
            $table->unsignedBigInteger('penandatangan_id')->nullable();
            $table->foreign('penandatangan_id')->references('id')->on('penandatangan');
        });

        // 4. Tabel Pivot spd_pegawai
        Schema::create('spd_pegawai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spd_id');
            $table->unsignedBigInteger('pegawai_id');
            $table->string('peran', 50)->default('utama');
            
            $table->foreign('spd_id')->references('id')->on('spd')->onDelete('cascade');
            $table->foreign('pegawai_id')->references('id')->on('pegawaibkd_spd')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spd_pegawai');
        Schema::dropIfExists('spd');
        Schema::dropIfExists('penandatangan');
        Schema::dropIfExists('pegawaibkd_spd');
    }
};
