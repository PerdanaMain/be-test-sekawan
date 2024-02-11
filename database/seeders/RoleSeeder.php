<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert some stuff into the roles table
        Role::insert([
            [
                'role_desc' => 'Admin',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'role_desc' => 'Manager Regional Office',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'role_desc' => 'Manager Head Office',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}