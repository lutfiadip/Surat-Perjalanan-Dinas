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
        Schema::table('spds', function (Blueprint $table) {
            $table->text('signatory_snapshot')->nullable()->after('penandatangan_id');
            $table->text('pptk_snapshot')->nullable()->after('signatory_snapshot');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spds', function (Blueprint $table) {
            $table->dropColumn(['signatory_snapshot', 'pptk_snapshot']);
        });
    }
};
