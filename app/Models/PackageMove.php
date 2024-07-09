<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageMove extends Model
{
    use HasFactory;

    public function user() 
    {
        return $this->belongsTo(User::class, 'handled_by');
    }
    public function package() 
    {
        return $this->belongsTo(Package::class);
    }

    protected $fillable = [
        'status', 'location', 'handled_by', 'package_id'
    ];
}
