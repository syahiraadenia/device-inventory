<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Buat tabel manufacturers terlebih dahulu
        Schema::create('manufacturers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // 2. Tambahkan kolom manufacturer_id ke tabel devices
        Schema::table('devices', function (Blueprint $table) {
            // Kita buat nullable dulu agar tidak error jika ada data lama
            $table->foreignId('manufacturer_id')->nullable()->constrained('manufacturers')->onDelete('set null');
        });
    }

    public function down(): void
    {
        // Hapus foreign key dan kolom di devices terlebih dahulu
        Schema::table('devices', function (Blueprint $table) {
            $table->dropForeign(['manufacturer_id']);
            $table->dropColumn('manufacturer_id');
        });

        // Baru hapus tabel manufacturers
        Schema::dropIfExists('manufacturers');
    }
};