<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert some stuff into the statuses table
        Status::insert([
            [
                'status_desc' => 'Pending Regional Office Approval',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status_desc' => 'Pending Head Office Approval',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status_desc' => 'Approved',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status_desc' => 'Rejected',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}