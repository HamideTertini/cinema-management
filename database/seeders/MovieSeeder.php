<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Category;

class MovieSeeder extends Seeder
{
    public function run()
    {
        // Merr kategoritë e para
        $category = Category::first(); 

        // Kontrollo nëse kategoria është gjetur
        if ($category) {
            // Krijo disa filma
            Movie::create([
                'title' => 'The Dark Knight',
                'category_id' => $category->id,
                'director' => 'Christopher Nolan',
                'release_date' => '2008-07-18',
                'synopsis' => 'A vigilante known as Batman seeks to stop a criminal mastermind known as the Joker.',
                'poster_image' => 'dark_knight_poster.jpg'
            ]);

            Movie::create([
                'title' => 'Inception',
                'category_id' => $category->id,
                'director' => 'Christopher Nolan',
                'release_date' => '2010-07-16',
                'synopsis' => 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a CEO.',
                'poster_image' => 'inception_poster.jpg'
            ]);

            Movie::create([
                'title' => 'The Matrix',
                'category_id' => $category->id,
                'director' => 'The Wachowskis',
                'release_date' => '1999-03-31',
                'synopsis' => 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.',
                'poster_image' => 'matrix_poster.jpg'
            ]);
        } else {
            echo "No categories found!";
        }
    }
}
