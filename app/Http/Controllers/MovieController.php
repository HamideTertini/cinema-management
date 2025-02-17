<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    // Funksioni për të marrë të gjithë filmat
    public function index()
    {
        $movies = Movie::with('category')->get();

        // Siguro që poster_image të kthehet si URL e plotë
        $movies->transform(function ($movie) {
            if ($movie->poster_image) {
                $movie->poster_image = asset('storage/' . $movie->poster_image);
            }
            return $movie;
        });

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
            'poster_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validimi për poster
        ]);

        $data = $request->all();

        // Ruaj posterin në storage dhe vendos path-in në databazë
        if ($request->hasFile('poster_image')) {
            $path = $request->file('poster_image')->store('posters', 'public');
            $data['poster_image'] = $path;
        }

        $movie = Movie::create($data);

        // Kthe URL-në e plotë të posterit
        if ($movie->poster_image) {
            $movie->poster_image = asset('storage/' . $movie->poster_image);
        }

        return response()->json($movie, 201);
    }

    // Funksioni për të marrë një film specifik
    public function show($id)
    {
        $movie = Movie::with('category')->find($id);

        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        // Kthe URL-në e plotë të posterit
        if ($movie->poster_image) {
            $movie->poster_image = asset('storage/' . $movie->poster_image);
        }

        return response()->json($movie);
    }

    // Funksioni për të përditësuar një film
    // Funksioni për të përditësuar një film
public function update(Request $request, $id)
{
    $movie = Movie::find($id);

    if (!$movie) {
        return response()->json(['error' => 'Movie not found'], 404);
    }

    $request->validate([
        'title' => 'sometimes|string|max:255',
        'category_id' => 'sometimes|exists:categories,id',
        'director' => 'sometimes|string|max:255',
        'release_date' => 'sometimes|date',
        'synopsis' => 'sometimes|string',
        'poster_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->all();

    // Nëse ka poster të ri, fshi të vjetrin dhe ruaj të riun
    if ($request->hasFile('poster_image')) {
        if ($movie->poster_image) {
            Storage::disk('public')->delete($movie->poster_image);
        }

        $path = $request->file('poster_image')->store('posters', 'public');
        $data['poster_image'] = $path;
    }

    $movie->update($data);

    // Kthe URL-në e plotë të posterit
    if ($movie->poster_image) {
        $movie->poster_image = asset('storage/' . $movie->poster_image);
    }

    return response()->json($movie);
}


    // Funksioni për të fshirë një film
    public function destroy($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }

        // Fshij posterin nga storage
        if ($movie->poster_image) {
            Storage::disk('public')->delete($movie->poster_image);
        }

        $movie->delete();

        return response()->json(['message' => 'Movie deleted successfully']);
    }
}
