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
        Schema::create('device_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manufacturer_id')->constrained()->onDelete('cascade');
            
            // Kolom baru untuk platform
            $table->foreignId('platform_id')
                  ->nullable()
                  ->constrained('platforms')
                  ->onDelete('set null');

            $table->string('model_name'); 
            $table->string('slug')->unique();
            $table->decimal('height', 5, 1)->default(1.0);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_types');
    }
};