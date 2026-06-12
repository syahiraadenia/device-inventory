<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug'); // Tambahkan kolom slug
            $table->foreignId('manufacturer_id')->nullable()->constrained('manufacturers')->onDelete('set null'); // Relasi ke manufacturers
            $table->text('description')->nullable(); // Tambahkan deskripsi
            $table->timestamps();
        });
    }

    public function down() { 
        Schema::dropIfExists('platforms'); 
    }
};