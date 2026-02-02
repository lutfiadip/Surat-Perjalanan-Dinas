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
        if (!Schema::hasColumn('spd', 'signatory_snapshot')) {
            Schema::table('spd', function (Blueprint $table) {
                $table->text('signatory_snapshot')->nullable()->after('penandatangan_id');
            });
        }

        if (!Schema::hasColumn('spd', 'pptk_snapshot')) {
            Schema::table('spd', function (Blueprint $table) {
                // If signatory_snapshot exists (added above or existed), put after it.
                // Otherwise put after penandatangan_id
                if (Schema::hasColumn('spd', 'signatory_snapshot')) {
                    $table->text('pptk_snapshot')->nullable()->after('signatory_snapshot');
                } else {
                    $table->text('pptk_snapshot')->nullable()->after('penandatangan_id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spd', function (Blueprint $table) {
            if (Schema::hasColumn('spd', 'pptk_snapshot')) {
                $table->dropColumn('pptk_snapshot');
            }
            if (Schema::hasColumn('spd', 'signatory_snapshot')) {
                $table->dropColumn('signatory_snapshot');
            }
        });
    }
};
