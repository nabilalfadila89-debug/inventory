<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return Item::with('category')->get();
    }

    public function store(Request $request)
{
    $item = new Item();

    $item->name = $request->name;
    $item->stock = $request->stock;
    $item->category_id = $request->category_id;

    $item->save();

    return response()->json($item);
}

    public function show(string $id)
    {
        return Item::with('category')->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $item = Item::findOrFail($id);
        $item->update($request->all());

        return $item;
    }

    public function destroy(string $id)
    {
        Item::destroy($id);

        return response()->json([
            'message' => 'Deleted'
        ]);
    }
}