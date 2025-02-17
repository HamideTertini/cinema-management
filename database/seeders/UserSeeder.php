<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role'=> 'admin',
            'password' => bcrypt('password'),
        ]);
    }
}
