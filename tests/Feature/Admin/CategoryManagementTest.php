<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryManagementTest extends TestCase
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

    public function test_admin_can_view_categories(): void
    {
        Category::factory()->count(2)->create();

        $response = $this->actingAs($this->admin)->getJson('/admin/api/categories');
        
        $response->assertStatus(200);
        $response->assertJsonCount(2, 'data');
    }

    public function test_admin_can_create_category(): void
    {
        $response = $this->actingAs($this->admin)->postJson('/admin/api/categories', [
            'name' => 'Electronics',
            'slug' => 'electronics',
            'is_active' => true
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', [
            'name' => 'Electronics'
        ]);
    }

    public function test_admin_can_delete_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->admin)->deleteJson("/admin/api/categories/{$category->id}");

        $response->assertStatus(200); // Or 204 depending on implementation
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id
        ]);
    }
}
