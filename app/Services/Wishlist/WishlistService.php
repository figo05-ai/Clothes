<?php
namespace App\Services\Wishlist;
use App\Contracts\Wishlist\WishlistServiceInterface;
use App\Models\Wishlist;

class WishlistService implements WishlistServiceInterface {
    public function getUserWishlist(string $userId) {
        return Wishlist::with('product')->where('user_id', $userId)->get();
    }
    
    public function toggleWishlist(string $userId, string $productId): array {
        $wishlist = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();
        
        if ($wishlist) {
            $wishlist->delete();
            return ['status' => 'removed'];
        }
        
        Wishlist::create(['user_id' => $userId, 'product_id' => $productId]);
        return ['status' => 'added'];
    }
}
