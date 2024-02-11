<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert some stuff into the types table
        Type::insert([
            [
                'type_desc' => 'Kendaraan Angkutan Barang',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'type_desc' => 'Kendaran Angkutan Orang',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}