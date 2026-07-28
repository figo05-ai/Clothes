<?php
namespace App\Contracts\Recommendation;
interface RecommendationServiceInterface {
    public function getRecommendationsForUser(string $userId, int $limit = 5);
}
