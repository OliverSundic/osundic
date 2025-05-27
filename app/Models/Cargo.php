<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $fillable = [
        'type', 
        'weight', 
        'description', 
        'user_id',
        'ship_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }
    
    use HasFactory;
}
