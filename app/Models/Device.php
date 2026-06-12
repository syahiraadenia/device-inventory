<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'device_type',
        'airflow',
        'serial_number',
        'site',
        'location',
        'rack',
        'face',
        'position',
        'status',
        'platform',
        'ip_address',
        'tenant',
        'tenant_group',
        'description'
    ];

    // Relasi: Setiap device punya satu tipe/model
   public function deviceType()
{
    return $this->belongsTo(DeviceType::class);
}

    // Relasi: Setiap device berada di satu lokasi (Site)
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}