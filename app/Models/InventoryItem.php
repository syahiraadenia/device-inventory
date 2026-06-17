<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    // Mengizinkan mass assignment untuk semua kolom
    protected $guarded = [];

    // Relasi ke Manufacturer (Milik satu Manufacturer)
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}