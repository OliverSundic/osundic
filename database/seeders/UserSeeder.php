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
            'email' => 'user1@pwa.rs',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Regular User 2',
            'email' => 'user2@pwa.rs',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        // Create editor user
        User::create([
            'name' => 'Editor User',
            'email' => 'editor@pwa.rs',
            'password' => Hash::make('editor'),
            'role' => 'editor'
        ]);

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@pwa.rs',
            'password' => Hash::make('admin'),
            'role' => 'admin'
        ]);

        // Optional: Create additional test users
        // User::factory()->count(5)->create();
    }
}