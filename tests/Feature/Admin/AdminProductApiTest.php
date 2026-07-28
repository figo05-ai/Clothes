<?php
namespace Tests\Feature\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Subcategory;

class AdminProductApiTest extends TestCase {
    use RefreshDatabase;

    protected function setUp(): void {
        parent::setUp();
    }

    public function test_admin_can_create_product() {
        $this->withoutExceptionHandling();
        $admin = User::factory()->create();
        $subcategory = Subcategory::factory()->create();

        $payload = [
            'name' => 'New Awesome Product',
            'subcategory_id' => $subcategory->id,
            'base_price' => 150.00,
            'stock_quantity' => 10,
            'short_description' => 'Short desc',
            'long_description' => 'A very nice product with long desc',
            'sku' => 'AWESOME-001',
            'slug' => 'new-awesome-product',
            'is_active' => true
        ];

        $response = $this->actingAs($admin)->postJson('/admin/api/products', $payload);
        $response->assertStatus(201);
        $this->assertDatabaseHas('products', ['sku' => 'AWESOME-001']);
    }
}
