<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeviceType extends Model
{
    protected $fillable = [
        'manufacturer_id', 'platform_id', 'model_name', 'slug', 'height', 'description'
    ];

    public function devices(): HasMany
    {
        return $this->hasMany(Device::class, 'device_type_id'); 
        // Sesuaikan 'device_type_id' dengan nama foreign key di tabel devices Anda
    }

    public function manufacturer() {
        return $this->belongsTo(Manufacturer::class);
    }

    // Nama method harus 'platform' (tunggal)
    public function platform() {
        return $this->belongsTo(Platform::class);
    }
}