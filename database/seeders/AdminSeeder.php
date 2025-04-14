<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $admins = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => 'password'
            ],
            [
                'name' => 'Admin Test',  // Your new admin
                'email' => 'test@admin.com',
                'password' => 'password123'
            ]
        ];

        foreach ($admins as $admin) {
            Admin::firstOrCreate(
                ['email' => $admin['email']],
                $admin
            );
        }
    }
}