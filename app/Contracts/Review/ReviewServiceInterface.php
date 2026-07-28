<?php
namespace App\Contracts\Review;
interface ReviewServiceInterface {
    public function getProductReviews(string $productId);
    public function addReview(string $userId, string $productId, array $data);
}
