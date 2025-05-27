<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Clear existing users (optional)
        // User::truncate();

        // Create regular users
        User::create([
            'name' => 'Regular User 1',
            'email' => 'user1@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Regular User 2',
            'email' => 'user2@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user'
        ]);

        // Create editor user
        User::create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'password' => Hash::make('editor123'),
            'role' => 'editor'
        ]);

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Optional: Create additional test users
        // User::factory()->count(5)->create();
    }
}