<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;

class ProductCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_home_page(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_user_can_view_product_details(): void
    {
        $product = Product::factory()->create(['status' => 'published']);
        
        $response = $this->get("/product/{$product->slug}");
        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_user_can_view_category(): void
    {
        $category = Category::factory()->create(['is_active' => true]);
        $subcategory = \App\Models\Subcategory::factory()->create(['category_id' => $category->id]);
        $product = Product::factory()->create(['subcategory_id' => $subcategory->id, 'status' => 'published']);
        
        $response = $this->get("/category/{$category->slug}");
        $response->assertStatus(200);
        $response->assertSee($category->name);
    }

    public function test_user_can_search_products(): void
    {
        $product = Product::factory()->create(['name' => 'Unique Shirt', 'status' => 'published']);
        
        $response = $this->get('/search?query=Unique');
        $response->assertStatus(200);
        $response->assertSee('Unique Shirt');
    }
}
