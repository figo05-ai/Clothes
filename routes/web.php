<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// ==========================================
// CUSTOMER CONTROLLERS
// ==========================================
use App\Http\Controllers\Product\ProductController as CustomerProductController;
use App\Http\Controllers\Catalog\CategoryController as CustomerCategoryController;
use App\Http\Controllers\Cart\CartController as CustomerCartController;
use App\Http\Controllers\Order\OrderController as CustomerOrderController;
use App\Http\Controllers\Wishlist\WishlistController as CustomerWishlistController;
use App\Http\Controllers\Wallet\WalletController as CustomerWalletController;
use App\Http\Controllers\Review\ReviewController as CustomerReviewController;
use App\Http\Controllers\Loyalty\LoyaltyController as CustomerLoyaltyController;
use App\Http\Controllers\Shipping\ShippingController as CustomerShippingController;
use App\Http\Controllers\RMA\ReturnController as CustomerReturnController;
use App\Http\Controllers\Support\SupportTicketController as CustomerSupportTicketController;
use App\Http\Controllers\Recommendation\RecommendationController as CustomerRecommendationController;
use App\Http\Controllers\Search\SearchController as CustomerSearchController;
use App\Http\Controllers\Content\ContentController as CustomerContentController;
use App\Http\Controllers\Discount\CouponController as CustomerCouponController;
use App\Http\Controllers\Payment\PaymentController as CustomerPaymentController;

// ==========================================
// ADMIN CONTROLLERS
// ==========================================
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Admin\WalletController as AdminWalletController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\ShippingController as AdminShippingController;
use App\Http\Controllers\Admin\ReturnController as AdminReturnController;
use App\Http\Controllers\Admin\SupportTicketController as AdminSupportTicketController;
use App\Http\Controllers\Admin\InventoryController as AdminInventoryController;
use App\Http\Controllers\Admin\MediaController as AdminMediaController;
use App\Http\Controllers\Admin\AnalyticsController as AdminAnalyticsController;
use App\Http\Controllers\Admin\ContentController as AdminContentController;

// ==========================================
// DEFAULT BREEZE ROUTES
// ==========================================
use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', function () { return view('dashboard'); })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

// ==========================================
// CUSTOMER APIs (/api/...)
// ==========================================
Route::prefix('api')->group(function () {
    // 1. Catalog & Products
    Route::get('/categories', [CustomerCategoryController::class, 'index']);
    Route::get('/categories/{id}', [CustomerCategoryController::class, 'show']);
    Route::get('/products', [CustomerProductController::class, 'index']);
    Route::get('/products/{id}', [CustomerProductController::class, 'show']);

    // 2. Cart, Coupons & Checkout
    Route::get('/cart', [CustomerCartController::class, 'index']);
    Route::post('/cart', [CustomerCartController::class, 'store']);
    Route::post('/coupons/apply', [CustomerCouponController::class, 'apply']);
    Route::post('/coupons/remove', [CustomerCouponController::class, 'remove']);
    Route::post('/checkout', [CustomerOrderController::class, 'checkout']);
    
    // Payments
    Route::post('/payments/{orderId}/generate', [CustomerPaymentController::class, 'generate']);
    Route::post('/payments/webhook', [CustomerPaymentController::class, 'webhook']);

    // Orders
    Route::get('/orders', [CustomerOrderController::class, 'index']);
    Route::get('/orders/{id}', [CustomerOrderController::class, 'show']);

    // 3. User Engagement (Wishlist, Wallet, Loyalty, Reviews)
    Route::get('/wishlist', [CustomerWishlistController::class, 'index']);
    Route::post('/wishlist/toggle', [CustomerWishlistController::class, 'toggle']);

    Route::get('/wallet/balance', [CustomerWalletController::class, 'balance']);
    Route::get('/wallet/transactions', [CustomerWalletController::class, 'transactions']);

    Route::get('/loyalty/balance', [CustomerLoyaltyController::class, 'balance']);
    Route::post('/loyalty/redeem', [CustomerLoyaltyController::class, 'redeem']);

    Route::get('/products/{id}/reviews', [CustomerReviewController::class, 'index']);
    Route::post('/products/{id}/reviews', [CustomerReviewController::class, 'store']);

    // 4. Logistics & Support (Shipping, Returns, Support Tickets)
    Route::get('/shipping/track/{trackingNumber}', [CustomerShippingController::class, 'track']);

    Route::get('/returns', [CustomerReturnController::class, 'index']);
    Route::post('/returns', [CustomerReturnController::class, 'store']);

    Route::get('/support/tickets', [CustomerSupportTicketController::class, 'index']);
    Route::post('/support/tickets', [CustomerSupportTicketController::class, 'store']);
    Route::post('/support/tickets/{id}/reply', [CustomerSupportTicketController::class, 'reply']);

    // 5. Advanced (Search, Recommendations, Content)
    Route::get('/search', [CustomerSearchController::class, 'search']);
    Route::get('/recommendations', [CustomerRecommendationController::class, 'index']);
    Route::get('/banners', [CustomerContentController::class, 'banners']);
    Route::get('/pages/{slug}', [CustomerContentController::class, 'page']);
});

// ==========================================
// ADMIN APIs (/admin/api/...)
// ==========================================
Route::prefix('admin/api')->group(function () {
    // 1. Catalog Admin
    Route::apiResource('categories', AdminCategoryController::class);
    Route::apiResource('products', AdminProductController::class);

    // 2. Orders & Coupons Admin
    Route::get('/orders', [AdminOrderController::class, 'index']);
    Route::get('/orders/{id}', [AdminOrderController::class, 'show']);
    Route::put('/orders/{id}/status', [AdminOrderController::class, 'updateStatus']);
    Route::apiResource('coupons', AdminCouponController::class);

    // 3. Engagement Admin (Wallet, Reviews)
    Route::post('/wallet/credit', [AdminWalletController::class, 'addCredit']);
    Route::get('/reviews/pending', [AdminReviewController::class, 'pending']);
    Route::put('/reviews/{id}/status', [AdminReviewController::class, 'updateStatus']);

    // 4. Logistics & Support Admin (Shipping, Returns, Support, Inventory)
    Route::post('/shipping', [AdminShippingController::class, 'store']);
    Route::put('/shipping/{trackingNumber}/status', [AdminShippingController::class, 'updateStatus']);

    Route::get('/returns', [AdminReturnController::class, 'index']);
    Route::put('/returns/{id}/status', [AdminReturnController::class, 'updateStatus']);

    Route::get('/support/tickets', [AdminSupportTicketController::class, 'index']);
    Route::put('/support/tickets/{id}/status', [AdminSupportTicketController::class, 'updateStatus']);
    Route::post('/support/tickets/{id}/reply', [AdminSupportTicketController::class, 'reply']);

    Route::get('/inventory/low-stock', [AdminInventoryController::class, 'lowStock']);
    Route::put('/inventory/{productId}/adjust', [AdminInventoryController::class, 'adjust']);

    // 5. Advanced Admin (Media, Content, Analytics)
    Route::post('/media/upload', [AdminMediaController::class, 'upload']);
    Route::post('/pages', [AdminContentController::class, 'storePage']);
    Route::post('/banners', [AdminContentController::class, 'storeBanner']);
    Route::get('/analytics/dashboard', [AdminAnalyticsController::class, 'index']);
});
