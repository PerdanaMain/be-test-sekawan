<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  Insert some stuff into the categories table
        Category::insert([
            [
                'category_desc' => 'Milik Sendiri',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category_desc' => 'Sewa',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}