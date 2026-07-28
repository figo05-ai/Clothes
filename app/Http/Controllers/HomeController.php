<?php

namespace App\Http\Controllers;






use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->where('is_active', true)->get();
        
        $newArrivals = Product::with('subcategory')
            ->where('status', 'published')
            ->latest()
            ->take(10)
            ->get();
            
        $bestSellers = Product::with('subcategory')
            ->where('status', 'published')
            ->where('is_featured', true)
            ->inRandomOrder()
            ->take(10)
            ->get();
            
        return view('welcome', compact('categories', 'newArrivals', 'bestSellers'));
    }
}
