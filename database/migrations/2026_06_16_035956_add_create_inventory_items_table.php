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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('serial_number')->unique()->nullable();
            
            // Foreign Key ke Manufacturers
            $table->foreignId('manufacturer_id')->constrained('manufacturers')->onDelete('cascade');
            
            // Kolom pendukung lainnya
            $table->string('asset_tag')->unique()->nullable();
            $table->enum('status', ['in_storage', 'deployed', 'broken', 'retired'])->default('in_storage');
            $table->text('description')->nullable();
            $table->date('purchase_date')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};