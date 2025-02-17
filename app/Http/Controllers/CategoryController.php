<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Funksioni për të marrë të gjitha kategoritë (me mundësinë e filtrimit)
    public function index(Request $request)
    {
        $query = Category::query();

        // Shtoni filtrimin nëse është kërkuar
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Merrni kategoritë nga baza e të dhënave
        $categories = $query->get();

        return response()->json($categories);
    }

    // Funksioni për të krijuar një kategori të re
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    // Funksioni për të marrë një kategori specifike
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    // Funksioni për të përditësuar një kategori
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $category->update($request->all());
        return response()->json($category);
    }

    // Funksioni për të fshirë një kategori
    public function destroy($id)
    {
        $user = auth()->user(); // Merr përdoruesin e kyçur

        if (!$user || $user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
