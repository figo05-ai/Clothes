<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        Banner::create([
            'title' => 'Summer Collection 2026',
            'image_url' => 'https://via.placeholder.com/1920x800?text=Summer+Collection+2026',
            'link_url' => '/category/men',
            'is_active' => true,
            'order' => 1
        ]);
        
        Banner::create([
            'title' => 'Women Winter Sale',
            'image_url' => 'https://via.placeholder.com/1920x800?text=Women+Winter+Sale',
            'link_url' => '/category/women',
            'is_active' => true,
            'order' => 2
        ]);
    }
}
