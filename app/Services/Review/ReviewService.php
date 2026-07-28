<?php
namespace App\Services\Review;
use App\Contracts\Review\ReviewServiceInterface;
use App\Contracts\Review\AdminReviewServiceInterface;
use App\Models\ProductReview;

class ReviewService implements ReviewServiceInterface, AdminReviewServiceInterface {
    public function getProductReviews(string $productId) {
        return ProductReview::with('user')->where('product_id', $productId)->where('status', 'approved')->get();
    }
    public function addReview(string $userId, string $productId, array $data) {
        return ProductReview::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'rating' => $data['rating'],
            'review_text' => $data['review_text'] ?? null,
            'status' => 'pending' // Requires admin approval
        ]);
    }
    public function getPendingReviews() {
        return ProductReview::with('user', 'product')->where('status', 'pending')->get();
    }
    public function updateReviewStatus(string $reviewId, string $status) {
        $review = ProductReview::findOrFail($reviewId);
        $review->status = $status;
        $review->save();
        return $review;
    }
}
