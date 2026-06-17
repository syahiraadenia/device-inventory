<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
protected $fillable = [
    'name', 
    'slug', 
    'status', 
    'description'
];    public function devices() {
        return $this->hasMany(Device::class);
    }
}