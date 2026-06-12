<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('devices', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Hostname perangkat (Contoh: SW-CORE-01)
        $table->foreignId('device_type_id')->constrained()->onDelete('cascade'); // Relasi ke Tipe/Model
        $table->foreignId('site_id')->constrained()->onDelete('cascade'); // Relasi ke Lokasi
        $table->string('serial_number')->unique()->nullable();
        $table->string('asset_tag')->unique()->nullable();
        $table->string('primary_ip')->nullable();
        $table->enum('status', ['active', 'offline', 'staged', 'failed'])->default('active');
        $table->text('description')->nullable();
        $table->timestamps();
    });
}
};
