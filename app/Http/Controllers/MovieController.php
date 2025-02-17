<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // Funksioni për të marrë të gjithë filmat
    public function index()
    {
        $movies = Movie::with('category')->get();
        return response()->json($movies);
    }

    // Funksioni për të krijuar një film të ri
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'director' => 'required|string|max:255',
            'release_date' => 'required|date',
            'synopsis' => 'required|string',
        ]);

        $movie = Movie::create($request->all());
        return response()->json($movie, 201);
    }

    // Funksioni për të marrë një film specifik
    public function show($id)
{
    $movie = Movie::find($id);

    if (!$movie) {
        return response()->json(['message' => 'Movie not found'], 404);
    }

    return response()->json($movie);
}


    // Funksioni për të përditësuar një film
    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }

        $movie->update($request->all());
        return response()->json($movie);
    }

    // Funksioni për të fshirë një film
    public function destroy($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }

        $movie->delete();
        return response()->json(['message' => 'Movie deleted successfully']);
    }
}

