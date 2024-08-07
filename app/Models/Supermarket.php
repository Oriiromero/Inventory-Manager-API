<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supermarket extends Model
{
    use HasFactory;
    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    protected $fillable = [
        'name', 'address', 'contact_email'
    ];
}