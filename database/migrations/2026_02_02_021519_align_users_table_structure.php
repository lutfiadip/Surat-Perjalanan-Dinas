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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name')->nullable()->after('id');
            }
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->enum('status', ['aktif', 'nonaktif'])->default('aktif')->after('password');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'user'])->default('user')->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Can't safely drop without knowing if we added them, 
            // generally align migrations are typically one-way fixes 
            // or we check exists before drop.
            if (Schema::hasColumn('users', 'username')) {
                $table->dropColumn('username');
            }
            // Be careful not to drop 'name' if it's standard, but here we added it if missing
            // For safety in dev environment, maybe redundant.
        });
    }
};
