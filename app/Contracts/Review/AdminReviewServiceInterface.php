<?php
namespace App\Contracts\Review;
interface AdminReviewServiceInterface {
    public function getPendingReviews();
    public function updateReviewStatus(string $reviewId, string $status);
}
