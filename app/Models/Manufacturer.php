<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $guarded = [];

    // Relasi ke Device Types
    public function deviceTypes() {
        return $this->hasMany(DeviceType::class);
    }

    // Relasi ke Platforms
    public function platforms() {
        return $this->hasMany(Platform::class);
    }

    // Relasi ke Inventory Items
    public function inventoryItems() {
        return $this->hasMany(InventoryItem::class);
    }
}