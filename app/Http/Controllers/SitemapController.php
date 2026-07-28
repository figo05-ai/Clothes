<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->get();
        $products = Product::where('status', 'published')->get();

        $content = '<?xml version="1.0" encoding="UTF-8"?>';
        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Homepage
        $content .= '<url>';
        $content .= '<loc>' . url('/') . '</loc>';
        $content .= '<changefreq>daily</changefreq>';
        $content .= '<priority>1.0</priority>';
        $content .= '</url>';

        // Categories
        foreach ($categories as $category) {
            $content .= '<url>';
            $content .= '<loc>' . url('/category/' . $category->slug) . '</loc>';
            $content .= '<changefreq>weekly</changefreq>';
            $content .= '<priority>0.8</priority>';
            $content .= '</url>';
        }

        // Products
        foreach ($products as $product) {
            $content .= '<url>';
            $content .= '<loc>' . url('/product/' . $product->slug) . '</loc>';
            $content .= '<lastmod>' . $product->updated_at->tz('UTC')->toAtomString() . '</lastmod>';
            $content .= '<changefreq>weekly</changefreq>';
            $content .= '<priority>0.8</priority>';
            $content .= '</url>';
        }

        $content .= '</urlset>';

        return response($content)->header('Content-Type', 'text/xml');
    }
}
