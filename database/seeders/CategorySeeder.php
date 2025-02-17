<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Krijo disa kategori
        Category::create(['name' => 'Action']);
        Category::create(['name' => 'Comedy']);
        Category::create(['name' => 'Drama']);
    }
}
