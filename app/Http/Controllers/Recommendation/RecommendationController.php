<?php
namespace App\Http\Controllers\Recommendation;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Recommendation\RecommendationServiceInterface;
use App\Http\Resources\Product\ProductResource; // Assuming ProductResource exists
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller {
    public function __construct(protected RecommendationServiceInterface $recService) {}
    #[OA\Get(
        path: '/api/recommendations',
        summary: 'Get list of Recommendations',
        tags: ['Customer - Recommendation'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index() {
        return ProductResource::collection($this->recService->getRecommendationsForUser(Auth::id() ?? 'guest'));
    }
}
