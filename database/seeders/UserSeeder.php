<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'admin',
            'role' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
        ]);

        // Author
        User::create([
            'name' => 'author',
            'role' => 'author',
            'email' => 'author@example.com',
            'password' => Hash::make('author123'),
        ]);

        // Participant
        User::create([
            'name' => 'participant',
            'role' => 'participant',
            'email' => 'participant@example.com',
            'password' => Hash::make('participant123'),
        ]);
    
        User::factory()->count(20)->create();
    }
}
