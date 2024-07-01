<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    public function supermarket() 
    {
        return $this->belongsTo(Supermarket::class);
    }

    public function packageMoves() 
    {
        return $this->hasOne(PackageMove::class);
    }

    protected $fillable = [
        'tracking_number', 'description', 'weight', 'dimensions', 'status', 'supermarket_id'
    ];

}