<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Krijo kategoritë
        $this->call(CategorySeeder::class);
        
        // Krijo filma
        $this->call(MovieSeeder::class);
    }
}
