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
        Schema::table('penandatangan', function (Blueprint $table) {
            // Adding jenis column, default to 'kepala' for existing records
            $table->enum('jenis', ['kepala', 'pptk'])->default('kepala')->after('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penandatangan', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }
};
