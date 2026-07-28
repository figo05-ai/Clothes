<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;

class CartApiTest extends TestCase {
    use RefreshDatabase;

    public function test_can_add_item_to_cart() {
        $user = User::factory()->create();
        $product = Product::factory()->create(['base_price' => 100]);
        
        $response = $this->actingAs($user)->postJson('/api/cart', [
            'product_id' => $product->id,
            'quantity' => 2
        ]);
        
        $response->assertStatus(200);
    }

    public function test_can_view_cart() {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->getJson('/api/cart');
        $response->assertStatus(200);
    }
}
