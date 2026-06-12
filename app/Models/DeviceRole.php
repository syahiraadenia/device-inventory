<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceRole extends Model
{
    // Mengizinkan semua kolom diisi (Mass Assignment)
    protected $guarded = [];

    // Relasi: Satu role bisa dimiliki oleh banyak device
    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}