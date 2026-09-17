<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('system_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('system_logs', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('system_logs', 'description')) {
                $table->text('description')->nullable()->after('details');
            }
        });
    }

    public function down(): void
    {
        Schema::table('system_logs', function (Blueprint $table) {
            if (Schema::hasColumn('system_logs', 'user_id')) {
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('system_logs', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};
