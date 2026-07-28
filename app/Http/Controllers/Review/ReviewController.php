<?php
namespace App\Http\Controllers\Review;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Review\ReviewServiceInterface;
use App\Http\Requests\Review\AddReviewRequest;
use App\Http\Resources\Review\ReviewResource;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller {
    public function __construct(protected ReviewServiceInterface $reviewService) {}
    #[OA\Get(
        path: '/api/products/{id}/reviews',
        summary: 'Get list of Reviews',
        tags: ['Customer - Review'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index(string $productId) {
        $reviews = $this->reviewService->getProductReviews($productId);
        return ReviewResource::collection($reviews);
    }
    #[OA\Post(
        path: '/api/products/{id}/reviews',
        summary: 'Create/Process Review (store)',
        tags: ['Customer - Review'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['rating', 'review_text'],
                properties: [
            new OA\Property(property: 'rating', type: 'integer'),
            new OA\Property(property: 'review_text', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Created successfully'),
            new OA\Response(response: 422, description: 'Validation Error')
        ]
    )]
    public function store(AddReviewRequest $request, string $productId) {
        $review = $this->reviewService->addReview(Auth::id() ?? 'guest', $productId, $request->validated());
        return response()->json(['success' => true, 'message' => 'Review submitted and awaiting approval.']);
    }
}
