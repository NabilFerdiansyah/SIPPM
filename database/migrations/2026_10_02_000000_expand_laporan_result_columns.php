<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            if (! Schema::hasColumn('laporans', 'inspection_result')) {
                $table->text('inspection_result')->nullable();
            }

            if (! Schema::hasColumn('laporans', 'root_cause')) {
                $table->text('root_cause')->nullable();
            }

            if (! Schema::hasColumn('laporans', 'action_taken')) {
                $table->text('action_taken')->nullable();
            }
        });

        // Hasil pemeriksaan dan tindakan teknisi dapat berupa uraian panjang.
        // Ubah kolom yang sudah ada menjadi TEXT agar tidak terkena MySQL 1406
        // (Data too long for column 'action_taken').
        Schema::table('laporans', function (Blueprint $table) {
            $table->text('inspection_result')->nullable()->change();
            $table->text('root_cause')->nullable()->change();
            $table->text('action_taken')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            if (Schema::hasColumn('laporans', 'inspection_result')) {
                $table->dropColumn('inspection_result');
            }

            if (Schema::hasColumn('laporans', 'root_cause')) {
                $table->dropColumn('root_cause');
            }

            if (Schema::hasColumn('laporans', 'action_taken')) {
                $table->dropColumn('action_taken');
            }
        });
    }
};
