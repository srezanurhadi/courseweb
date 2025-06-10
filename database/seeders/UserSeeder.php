<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Reza Nurhadi Saputra',
            'role' => 'admin',
            'email' => 'rnsaputra12@gmail.com',
            'password'=> Hash::make('Reza1234')
        ]);
        User::factory()->count(20)->create();
    }
}
