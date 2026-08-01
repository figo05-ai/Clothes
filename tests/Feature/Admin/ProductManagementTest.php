<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;

class ProductManagementTest extends TestCase
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

    public function test_admin_can_view_products(): void
    {
        Product::factory()->count(3)->create();

        $response = $this->actingAs($this->admin)->getJson('/admin/api/products');
        $response->assertStatus(200);
        $response->assertJsonCount(3, 'data');
    }

    public function test_admin_can_create_product(): void
    {
        $category = Category::factory()->create();
        $subcategory = Subcategory::factory()->create(['category_id' => $category->id]);

        $productData = [
            'name' => 'New Product',
            'base_price' => 150,
            'stock_quantity' => 50,
            'subcategory_id' => $subcategory->id,
            'slug' => 'new-product-123',
            'sku' => 'NP-123',
            'short_description' => 'Short desc',
            'long_description' => 'Long desc'
        ];

        $response = $this->actingAs($this->admin)->postJson('/admin/api/products', $productData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('products', [
            'sku' => 'NP-123'
        ]);
    }

    public function test_admin_can_update_product(): void
    {
        $product = Product::factory()->create(['name' => 'Old Name', 'base_price' => 100]);
        $category = Category::factory()->create();

        $response = $this->actingAs($this->admin)->putJson("/admin/api/products/{$product->id}", [
            'name' => 'Updated Name',
            'base_price' => 200,
            'category_id' => $category->id,
            'stock_quantity' => 10
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Name',
            'base_price' => 200
        ]);
    }

    public function test_admin_can_delete_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->admin)->deleteJson("/admin/api/products/{$product->id}");
        $response->assertStatus(200);
        
        // Soft delete assertion
        $this->assertSoftDeleted('products', [
            'id' => $product->id
        ]);
    }
}
