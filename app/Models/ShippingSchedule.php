<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingSchedule extends Model
{
    protected $fillable = [
        'ship_id', 
        'departure_port_id', 
        'arrival_port_id', 
        'departure_time',
        'arrival_time',
        'price'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }

    public function departurePort()
    {
        return $this->belongsTo(Port::class, 'departure_port_id');
    }

    public function arrivalPort()
    {
        return $this->belongsTo(Port::class, 'arrival_port_id');
    }
}