<?php
namespace App\Contracts\Wishlist;

interface WishlistServiceInterface {
    public function getUserWishlist(string $userId);
    public function toggleWishlist(string $userId, string $productId): array;
}
