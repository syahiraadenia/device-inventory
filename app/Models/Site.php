<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
protected $fillable = [
    'name', 
    'slug', 
    'status', 
    'facility', 
    'region_id', 
    'group_id'
];    public function devices() {
        return $this->hasMany(Device::class);
    }
}