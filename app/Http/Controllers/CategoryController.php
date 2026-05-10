<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        return Category::create($request->all());
    }

    public function show(string $id)
    {
        return Category::findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return $category;
    }

    public function destroy(string $id)
    {
        Category::destroy($id);

        return response()->json([
            'message' => 'Deleted'
        ]);
    }
}