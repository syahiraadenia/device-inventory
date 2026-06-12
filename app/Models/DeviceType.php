<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
    protected $fillable = [
        'manufacturer_id', 'platform_id', 'model_name', 'slug', 'height', 'description'
    ];

    public function manufacturer() {
        return $this->belongsTo(Manufacturer::class);
    }

    // Nama method harus 'platform' (tunggal)
    public function platform() {
        return $this->belongsTo(Platform::class);
    }
}