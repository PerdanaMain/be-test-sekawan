<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $primaryKey = 'driver_id';
    protected $fillable = [
        'driver_name',
        'driver_phone',
        'driver_address',
        'driver_picture',
    ];
}