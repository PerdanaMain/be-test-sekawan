<?php

namespace Database\Seeders;

use App\Models\Maintenance;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert some stuff into the maintenances table
        Maintenance::insert([
            [
                'vehicle_id' => 1,
                'maintenance_date' => '2021-01-01',
                'maintenance_desc' => 'Ganti Oli',
                'maintenance_cost' => 100000,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'vehicle_id' => 1,
                'maintenance_date' => '2021-01-02',
                'maintenance_desc' => 'Ganti Ban',
                'maintenance_cost' => 200000,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'vehicle_id' => 2,
                'maintenance_date' => '2021-01-03',
                'maintenance_desc' => 'Ganti Oli',
                'maintenance_cost' => 100000,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'vehicle_id' => 2,
                'maintenance_date' => '2021-01-04',
                'maintenance_desc' => 'Ganti Ban',
                'maintenance_cost' => 200000,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'vehicle_id' => 3,
                'maintenance_date' => '2021-01-05',
                'maintenance_desc' => 'Ganti Oli',
                'maintenance_cost' => 100000,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'vehicle_id' => 3,
                'maintenance_date' => '2021-01-06',
                'maintenance_desc' => 'Ganti Ban',
                'maintenance_cost' => 200000,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'vehicle_id' => 4,
                'maintenance_date' => '2021-01-07',
                'maintenance_desc' => 'Ganti Oli',
                'maintenance_cost' => 100000,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'vehicle_id' => 4,
                'maintenance_date' => '2021-01-08',
                'maintenance_desc' => 'Ganti Ban',
                'maintenance_cost' => 200000,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}