<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Facades\Log;

class ItemService
{
    /**
     * Mengambil semua item.
     */
    public function all()
    {
        return Item::all();
    }

    /**
     * Mengambil satu item berdasarkan ID.
     */
    public function find($id)
    {
        return Item::findOrFail($id);
    }

    /**
     * Menambahkan item baru.
     */
    public function create(array $data)
    {
        Log::info('Create Item', $data);

        return Item::create($data);
    }

    /**
     * Mengupdate item.
     */
    public function update($id, array $data)
    {
        $item = Item::findOrFail($id);

        Log::info('Update Item', [
            'id' => $item->id,
            'data' => $data
        ]);

        $item->update($data);

        return $item;
    }

    /**
     * Menghapus item.
     */
    public function delete($id)
    {
        $item = Item::findOrFail($id);

        Log::info('Delete Item', [
            'id' => $item->id
        ]);

        return $item->delete();
    }
}