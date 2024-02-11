<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Vehicle;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // loop 15 times
        $faker = Faker::create();
        $vehicles = Vehicle::all();
        for ($i = 1; $i <= 15; $i++) {
            // Insert some stuff into the drivers table
            Driver::insert([
                [
                    'driver_name' => $faker->name(),
                    'driver_phone' => '081234567890',
                    'driver_address' => 'Jl. Jendral Sudirman No. 1',
                    'driver_picture' => rand(1, 100) . '.jpg',
                    "created_at" => now(),
                    "updated_at" => now(),
                ],
            ]);
        }
    }
}