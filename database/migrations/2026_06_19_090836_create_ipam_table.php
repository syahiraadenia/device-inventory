<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ipam', function (Blueprint $table) {
            $table->id();
            // Diubah menjadi device_id agar konsisten
            $table->foreignId('device_id')->constrained('devices')->onDelete('cascade'); 
            $table->ipAddress('ip_address')->unique(); 
            $table->string('gateway')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ipam');
    }
};