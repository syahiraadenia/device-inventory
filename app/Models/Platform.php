<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    // Pastikan ini ada dan berisi nama kolom yang sama dengan di database/migration
    protected $fillable = ['name', 'slug' , 'description'];

public function devices()
{
    return $this->hasMany(Device::class);
}
}