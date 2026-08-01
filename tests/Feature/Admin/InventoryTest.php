<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Product;

class InventoryTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::factory()->create();
        $role = Role::create(['name' => 'admin']);
        $this->admin->roles()->attach($role);
    }

    public function test_admin_can_view_low_stock_products(): void
    {
        Product::factory()->create(['stock_quantity' => 5]); // Low stock
        Product::factory()->create(['stock_quantity' => 20]); // Normal stock

        $response = $this->actingAs($this->admin)->getJson('/inventory/low-stock?threshold=10');
        // NOTE: Depending on the route (admin/api/inventory/low-stock or web), this might need adjustment.
        // Assuming web route for now: /inventory/low-stock
        // If it's prefixed by admin, we will see in the test result.
        
        // Wait, looking at routes/web.php, it's just /inventory/low-stock. But the prefix might be admin.
        // I'll test with /inventory/low-stock. Let's run it.
        $response = $this->actingAs($this->admin)->getJson('/admin/api/inventory/low-stock?threshold=10');
        
        // Wait, the controller method has OA\Post path: '/admin/api/inventory/low-stock'
        // If it fails with 404 I will check the exact route.
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
    }

    public function test_admin_can_adjust_stock(): void
    {
        $product = Product::factory()->create(['stock_quantity' => 10]);

        $response = $this->actingAs($this->admin)->putJson("/admin/api/inventory/{$product->id}/adjust", [
            'quantity' => 20,
            'reason' => 'Restock'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock_quantity' => 20
        ]);
        
        $product->refresh();
        $this->assertEquals(20, $product->stock_quantity);
    }
}
