<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    // Pastikan kolom-kolom ini ada di tabel 'devices' kamu
    protected $fillable = [
    'name', 
    'device_role_id', 
    'department', 
    'status', 
    'device_type_id', 
    'site_id', 
    'owner_name', 
    'manufacturer', 
    'serial_number', 
    'purchase_date'
];

    // Relasi ke DeviceRole (MENGATASI ERROR COUNT)
    public function deviceRole()
{
    // Pastikan nama kolomnya adalah 'device_role_id'
    return $this->belongsTo(DeviceRole::class, 'device_role_id');
}

    // Relasi ke DeviceType
    public function deviceType()
    {
        return $this->belongsTo(DeviceType::class, 'device_type_id');
    }

    // Relasi ke Site
    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }
}