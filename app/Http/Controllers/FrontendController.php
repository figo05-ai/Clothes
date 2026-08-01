<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class FrontendController extends Controller
{
    public function product($slug)
    {
        $product = Product::with(['images', 'variants', 'subcategory.category', 'reviews.user'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $relatedProducts = Product::with('images')
            ->where('subcategory_id', $product->subcategory_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'published')
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('frontend.product', compact('product', 'relatedProducts'));
    }

    public function category(Request $request, $slug)
    {
        $category = Category::with('subcategories')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $query = Product::with('images')->whereHas('subcategory', function($q) use ($category) {
            $q->where('category_id', $category->id);
        })->where('status', 'published');

        // Apply filters
        if ($request->has('subcategory')) {
            $query->whereHas('subcategory', function($q) use ($request) {
                $q->where('slug', $request->subcategory);
            });
        }
        if ($request->filled('min_price')) {
            $query->where('base_price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('base_price', '<=', $request->max_price);
        }
        if ($request->has('size') || $request->has('color')) {
            $query->whereHas('variants', function($q) use ($request) {
                if ($request->has('size') && !empty($request->size)) {
                    $q->whereIn('size', (array)$request->size);
                }
                if ($request->has('color') && !empty($request->color)) {
                    $q->whereIn('color', (array)$request->color);
                }
            });
        }
        
        // Sorting
        $sort = $request->input('sort', 'latest');
        if ($sort == 'price_low') {
            $query->orderBy('base_price', 'asc');
        } elseif ($sort == 'price_high') {
            $query->orderBy('base_price', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->appends($request->all());

        return view('frontend.category', compact('category', 'products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        
        $products = Product::with('images')->where('status', 'published')
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('short_description', 'like', "%{$query}%");
            })
            ->paginate(12);

        return view('frontend.search', compact('products', 'query'));
    }

    public function checkout()
    {
        // Get the cart from CartService
        $cartService = app(\App\Contracts\Cart\CartServiceInterface::class);
        $discountService = app(\App\Contracts\Discount\DiscountServiceInterface::class);
        $cart = $cartService->getCart();

        if (empty($cart)) {
            return redirect('/')->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += ($item['price'] * $item['quantity']);
        }

        $total = $discountService->calculateTotal($subtotal);
        $discount = $subtotal - $total;
        $coupon = session('applied_coupon');
        
        $walletBalance = 0;
        $walletIsActive = false;
        if (auth()->check()) {
            $walletService = app(\App\Contracts\Wallet\WalletServiceInterface::class);
            $walletBalance = $walletService->getBalance(auth()->id());
            $walletIsActive = $walletService->isActive(auth()->id());
        }

        return view('frontend.checkout', compact('cart', 'subtotal', 'total', 'discount', 'coupon', 'walletBalance', 'walletIsActive'));
    }

    public function orderSuccess(\Illuminate\Http\Request $request)
    {
        $orderId = $request->query('id');
        return view('frontend.order_success', compact('orderId'));
    }

    public function dashboard()
    {
        if (auth()->check() && auth()->user()->roles->contains('name', 'admin')) {
            return redirect('/admin');
        }
        $user = auth()->user();

        $walletService = app(\App\Contracts\Wallet\WalletServiceInterface::class);
        $loyaltyService = app(\App\Contracts\Loyalty\LoyaltyServiceInterface::class);

        $walletBalance = $walletService->getBalance($user->id);
        $loyaltyPoints = $loyaltyService->getBalance($user->id);

        return view('frontend.dashboard', compact('user', 'walletBalance', 'loyaltyPoints'));
    }

    public function orders()
    {
        $orders = \App\Models\Order::where('user_id', auth()->id())->latest()->get();
        return view('frontend.orders', compact('orders'));
    }

    public function preferences()
    {
        $user = auth()->user();
        $preferences = \App\Models\UserPreference::firstOrCreate(
            ['user_id' => $user->id],
            [
                'enable_recommendations' => true
            ]
        );
        return view('frontend.preferences', compact('user', 'preferences'));
    }

    public function updatePreferences(Request $request)
    {
        $request->validate([
            'preferred_top_size' => 'nullable|string|max:10',
            'preferred_bottom_size' => 'nullable|string|max:10',
            'shoe_size' => 'nullable|string|max:10',
            'enable_recommendations' => 'nullable|boolean'
        ]);

        $preferences = \App\Models\UserPreference::firstOrCreate(['user_id' => auth()->id()]);
        
        $preferences->update([
            'preferred_top_size' => $request->preferred_top_size,
            'preferred_bottom_size' => $request->preferred_bottom_size,
            'shoe_size' => $request->shoe_size,
            'enable_recommendations' => $request->has('enable_recommendations') ? true : false,
        ]);

        return redirect()->route('dashboard.preferences')->with('success', 'Your preferences have been updated successfully.');
    }

    public function wishlist()
    {
        $wishlistService = app(\App\Contracts\Wishlist\WishlistServiceInterface::class);
        $wishlist = $wishlistService->getUserWishlist(auth()->id()); 
        return view('frontend.wishlist', compact('wishlist'));
    }

    public function returns()
    {
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        $orders = \App\Models\Order::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('frontend.returns', compact('orders'));
    }

    public function contact()
    {
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        return view('frontend.contact');
    }

    public function page($slug)
    {
        $page = \App\Models\Page::where('slug', $slug)->firstOrFail();
        return view('frontend.page', compact('page'));
    }
}
