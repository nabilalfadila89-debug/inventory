<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemApiTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        Sanctum::actingAs($user);

        return $user;
    }

    public function test_can_get_items()
    {
        $this->authenticate();

        $category = Category::factory()->create();

        Item::factory()->count(3)->create([
            'category_id' => $category->id,
        ]);

        $response = $this->getJson('/api/v1/items');

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                 ]);
    }

    public function test_can_create_item()
    {
        $this->authenticate();

        $category = Category::factory()->create();

        $response = $this->postJson('/api/v1/items', [
            'name' => 'Laptop Asus',
            'quantity' => 10,
            'price' => 8500000,
            'category_id' => $category->id,
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Item berhasil dibuat',
                 ]);

        $this->assertDatabaseHas('items', [
            'name' => 'Laptop Asus',
        ]);
    }

    public function test_can_update_item()
    {
        $this->authenticate();

        $category = Category::factory()->create();

        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);

        $response = $this->putJson("/api/v1/items/{$item->id}", [
            'name' => 'Laptop Baru',
            'quantity' => 20,
            'price' => 9000000,
            'category_id' => $category->id,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                 ]);

        $this->assertDatabaseHas('items', [
            'name' => 'Laptop Baru',
        ]);
    }

    public function test_can_delete_item()
    {
        $this->authenticate();

        $category = Category::factory()->create();

        $item = Item::factory()->create([
            'category_id' => $category->id,
        ]);

        $response = $this->deleteJson("/api/v1/items/{$item->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('items', [
            'id' => $item->id,
        ]);
    }
}