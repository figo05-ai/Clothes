<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;

class ContentTest extends TestCase
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

    public function test_admin_can_create_page(): void
    {
        $response = $this->actingAs($this->admin)->postJson('/admin/api/pages', [
            'title' => 'About Us',
            'slug' => 'about-us',
            'content' => 'This is the about us page.',
            'is_active' => true
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('pages', [
            'slug' => 'about-us',
            'title' => 'About Us'
        ]);
    }

    public function test_admin_can_create_banner(): void
    {
        $response = $this->actingAs($this->admin)->postJson('/admin/api/banners', [
            'title' => 'Summer Sale',
            'image_url' => 'https://example.com/summer.jpg',
            'link_url' => 'https://example.com/sale',
            'order' => 1,
            'is_active' => true
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('banners', [
            'title' => 'Summer Sale',
            'order' => 1
        ]);
    }
}
