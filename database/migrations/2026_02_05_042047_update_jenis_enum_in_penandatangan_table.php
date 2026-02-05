<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE penandatangan MODIFY COLUMN jenis ENUM('kepala', 'pptk', 'bendahara', 'sekretaris', 'kasubbag') NOT NULL DEFAULT 'kepala'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE penandatangan MODIFY COLUMN jenis ENUM('kepala', 'pptk') NOT NULL DEFAULT 'kepala'");
    }
};
