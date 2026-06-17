<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceRole extends Model
{
    protected $guarded = [];

    public function devices()
{
    // Pastikan di sini juga 'device_role_id'
    return $this->hasMany(Device::class, 'device_role_id');
}
}