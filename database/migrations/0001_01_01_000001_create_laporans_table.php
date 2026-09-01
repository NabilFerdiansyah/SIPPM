<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->foreignId('operator_id')->constrained('users')->cascadeOnDelete();
            $table->string('mesin');
            $table->string('lokasi')->nullable();
            $table->enum('kategori', ['mekanik', 'elektrik', 'instrumentasi']);
            $table->string('kondisi');
            $table->enum('tingkat', ['ringan', 'sedang', 'berat'])->default('sedang');
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->enum('status', [
                'baru', 'divalidasi', 'ditugaskan', 'dikerjakan',
                'menunggu_validasi_akhir', 'selesai', 'ditolak',
            ])->default('baru');
            $table->text('catatan_supervisor')->nullable();
            $table->text('catatan_penolakan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
