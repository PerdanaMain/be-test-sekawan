<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $primaryKey = 'maintenance_id';
    protected $fillable = [
        'vehicle_id',
        'maintenance_desc',
        'maintenance_cost',
        'maintenance_date',
    ];
}