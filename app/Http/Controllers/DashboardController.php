<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{



    // Metoda për të shfaqur statistikat dhe informacionin në dashboard
    public function index()
    {
        // Kontrollon nëse përdoruesi ka rolin 'admin'
        if (auth()->user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403); // Kthehet një gabim 403 nëse nuk është admin
        }

        // Merr të dhënat për numrin e filmave dhe kategorive
        $moviesCount = Movie::count();
        $categoriesCount = Category::count();

        return response()->json([
            'movies_count' => $moviesCount,
            'categories_count' => $categoriesCount,
        ]);
    }

    // Funksioni për të marrë statistikat (numrin e filmave dhe kategorive)
    public function dashboardStatistics()
    {
        // Kontrollon nëse përdoruesi ka rolin 'admin'
        if (auth()->user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403); // Kthehet një gabim 403 nëse nuk është admin
        }

        // Numri i filmave
        $movieCount = Movie::count();

        // Numri i kategorive
        $categoryCount = Category::count();

        // Kthe statistikën në formatin JSON
        return response()->json([
            'movies' => $movieCount,
            'categories' => $categoryCount,
        ]);
    }
}
