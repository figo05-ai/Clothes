<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;

class WishlistTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_toggle_wishlist(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // Add to wishlist
        $response = $this->actingAs($user)->postJson('/api/wishlist/toggle', [
            'product_id' => $product->id
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('wishlists', [
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);

        // Remove from wishlist
        $response = $this->actingAs($user)->postJson('/api/wishlist/toggle', [
            'product_id' => $product->id
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('wishlists', [
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);
    }

    public function test_user_can_view_wishlist(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user)->postJson('/api/wishlist/toggle', [
            'product_id' => $product->id
        ]);

        $response = $this->actingAs($user)->getJson('/api/wishlist');
        $response->assertStatus(200);
    }
}
