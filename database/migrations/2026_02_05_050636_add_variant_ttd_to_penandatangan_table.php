<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            // Jalur khusus untuk SQLite (Gunakan String biasa, tanpa AFTER)
            Schema::table('penandatangan', function (Blueprint $table) {
                $table->string('variant_ttd')->default('normal');
            });
        } else {
            // Kode asli Anda untuk MySQL
            DB::statement("ALTER TABLE penandatangan ADD COLUMN variant_ttd ENUM('normal', 'plt', 'plh') NOT NULL DEFAULT 'normal' AFTER jenis");
        }
    }

    public function down(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            Schema::table('penandatangan', function (Blueprint $table) {
                $table->dropColumn('variant_ttd');
            });
        } else {
            Schema::table('penandatangan', function (Blueprint $table) {
                $table->dropColumn('variant_ttd');
            });
        }
    }
};