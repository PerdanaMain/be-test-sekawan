<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $primaryKey = 'vehicle_id';
    protected $fillable = [
        "status_id",
        "type_id",
        'category_id',
        "driver_id",
        'vehicle_name',
        'vehicle_vin',
        'vehicle_year',
        'vehicle_price',
        'vehicle_fuel',
        'vehicle_picture',
    ];
}