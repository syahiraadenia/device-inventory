<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Platform;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'device_role_id', 
        'device_type_id', 
        'site_id', 
        'platform_id', 
        'manufacturer_id', 
        'owner_name', 
        'department', 
        'status', 
        'serial_number', 
        'purchase_date'
    ];

    // DIUBAH: Sekarang menggunakan 'device_id' untuk konsistensi
    public function ipam()
    {
        return $this->hasOne(IPAM::class, 'device_id');
    }

    // Relasi ke DeviceRole
    public function deviceRole()
    {
        return $this->belongsTo(DeviceRole::class, 'device_role_id');
    }

    // Relasi ke DeviceType
    public function deviceType()
    {
        return $this->belongsTo(DeviceType::class, 'device_type_id');
    }

    // Relasi ke Platform
    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id');
    }
    
    // Relasi ke Site
    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }
}