<?php
namespace App\Services\Recommendation;
use App\Contracts\Recommendation\RecommendationServiceInterface;
use App\Models\Product;

class RecommendationService implements RecommendationServiceInterface {
    public function getRecommendationsForUser(string $userId, int $limit = 5) {
        // Simple mock recommendation logic: get top selling or latest products
        return Product::inRandomOrder()->take($limit)->get();
    }
}
