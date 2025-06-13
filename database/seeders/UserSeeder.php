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

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'admin',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'author@example.com'],
            [
                'name' => 'author',
                'role' => 'author',
                'password' => Hash::make('author123'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'participant@example.com'],
            [
                'name' => 'participant',
                'role' => 'participant',
                'password' => Hash::make('participant123'),
            ]
        );

        if (User::count() < 23) {
            User::factory()->count(23 - User::count())->create();
        }
    }
}
