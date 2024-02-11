<?php

namespace Database\Seeders;

use App\Models\Log;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class LogSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = Vehicle::all();

        // Insert some stuff into the logs table
        Log::insert([
            [
                "vehicle_id" => rand(1, count($vehicles)),
                'log_desc' => 'Kendaraan dipakai untuk keperluan operasional ke kantor cabang',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "vehicle_id" => rand(1, count($vehicles)),
                'log_desc' => 'Kendaraan dipakai untuk keperluan operasional ke kantor pusat',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "vehicle_id" => rand(1, count($vehicles)),
                'log_desc' => 'Kendaraan dipakai untuk keperluan operasional ke kantor cabang dan kantor pusat',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "vehicle_id" => rand(1, count($vehicles)),
                'log_desc' => 'Kendaraan dipakai untuk keperluan operasional ke kantor cabang, kantor pusat, dan kegiatan operasional lainnya',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "vehicle_id" => rand(1, count($vehicles)),
                'log_desc' => 'Kendaraan dipakai untuk perjalanan dinas ke kota malang',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "vehicle_id" => rand(1, count($vehicles)),
                'log_desc' => 'Kendaraan dipakai untuk perjalanan dinas ke kota surabaya',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "vehicle_id" => rand(1, count($vehicles)),
                'log_desc' => 'Kendaraan dipakai untuk perjalanan dinas ke kota jakarta',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "vehicle_id" => rand(1, count($vehicles)),
                'log_desc' => 'Kendaraan dipakai untuk perjalanan dinas ke kota bandung',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "vehicle_id" => rand(1, count($vehicles)),
                'log_desc' => 'Kendaraan dipakai untuk perjalanan dinas ke kota semarang',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "vehicle_id" => rand(1, count($vehicles)),
                'log_desc' => 'Kendaraan dipakai untuk perjalanan dinas ke kota yogyakarta',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}