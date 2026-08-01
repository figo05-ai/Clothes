<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_item_to_cart(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['base_price' => 100, 'stock_quantity' => 10]);

        $response = $this->actingAs($user)->postJson('/api/cart', [
            'product_id' => $product->id,
            'quantity' => 2
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('cart_items', [
            'product_id' => $product->id,
            'quantity' => 2
        ]);
    }

    public function test_user_can_view_their_cart(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['base_price' => 100, 'stock_quantity' => 10]);

        $this->actingAs($user)->postJson('/api/cart', [
            'product_id' => $product->id,
            'quantity' => 1
        ]);

        $response = $this->actingAs($user)->getJson('/api/cart');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'items' => [
                    '*' => [
                        'product_id',
                        'quantity'
                    ]
                ],
                'summary' => [
                    'total_items',
                    'total_price'
                ]
            ]
        ]);
    }

    public function test_user_can_remove_item_from_cart(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['base_price' => 100, 'stock_quantity' => 10]);

        // Add to cart
        $this->actingAs($user)->postJson('/api/cart', [
            'product_id' => $product->id,
            'quantity' => 1
        ]);

        $this->assertDatabaseHas('cart_items', [
            'product_id' => $product->id,
        ]);

        // Remove from cart
        $response = $this->actingAs($user)->deleteJson("/api/cart/{$product->id}");
        
        $response->assertStatus(200);
        $this->assertDatabaseMissing('cart_items', [
            'product_id' => $product->id,
        ]);
    }
}
