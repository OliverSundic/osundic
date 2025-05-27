<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $fillable = [
        'name',
        'type',
        'capacity',
        'year_built',
        'status',
        'image_path',
        'visible'
    ];

    protected $casts = [
        'visible' => 'boolean'
    ];

    public function cargos()
    {
        return $this->hasMany(Cargo::class);
    }

    public function shippingSchedules()
    {
        return $this->hasMany(ShippingSchedule::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return null;
    }
}