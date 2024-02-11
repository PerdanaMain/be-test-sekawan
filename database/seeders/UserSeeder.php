<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use \App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'role_id' => 1,
                'user_name' => 'Admin',
                'user_email' => 'admin@vms.com',
                "password" => Hash::make('12345'),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'role_id' => 2,
                'user_name' => 'Manager Regional Office',
                'user_email' => 'man_ro@vms.com',
                "password" => Hash::make('12345'),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'role_id' => 3,
                'user_name' => 'Manager Head Office',
                'user_email' => 'man_ho@vms.com',
                "password" => Hash::make('12345'),
                "created_at" => now(),
                "updated_at" => now(),
            ],

        ]);

    }
}