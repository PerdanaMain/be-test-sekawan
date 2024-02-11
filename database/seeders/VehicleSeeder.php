<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

// use vehicles table

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // loop 15 times
        for ($i = 1; $i <= 15; $i++) {
            // Insert some stuff into the vehicles table
            Vehicle::insert([
                [
                    'status_id' => rand(1, 4),
                    'type_id' => rand(1, 2),
                    'category_id' => rand(1, 2),
                    'driver_id' => rand(1, 15),
                    'vehicle_name' => 'Vehicle ' . $i,
                    'vehicle_vin' => Str::upper(Str::random(1)) . ' ' . rand(1000, 9999) . ' ' . Str::upper(Str::random(3)),
                    'vehicle_year' => rand(2010, 2021),
                    'vehicle_price' => rand(100000, 1000000),
                    'vehicle_fuel' => 'Gasoline',
                    'vehicle_picture' => 'car' . rand(10, 25) . '.min' . '.jpg',
                    "created_at" => now(),
                    "updated_at" => now(),
                ],
            ]);
        }
    }
}