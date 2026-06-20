<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IPAM extends Model
{
    // Nama tabel di database
    protected $table = 'ipam';

    // Menggunakan device_id sesuai standarisasi baru
    protected $fillable = [
        'device_id', 
        'ip_address', 
        'gateway'
    ];

    // Relasi ke Device (menggunakan device_id sebagai foreign key)
    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }
}