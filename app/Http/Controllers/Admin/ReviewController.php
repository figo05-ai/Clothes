<?php
namespace App\Http\Controllers\Admin;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Review\AdminReviewServiceInterface;
use App\Http\Requests\Admin\UpdateReviewStatusRequest;
use App\Http\Resources\Admin\AdminReviewResource;

class ReviewController extends Controller {
    public function __construct(protected AdminReviewServiceInterface $adminReviewService) {}
    #[OA\Post(
        path: '/admin/api/reviews/pending',
        summary: 'pending operation',
        tags: ['Admin - Review'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function pending() {
        return AdminReviewResource::collection($this->adminReviewService->getPendingReviews());
    }
    #[OA\Put(
        path: '/admin/api/reviews/{id}/status',
        summary: 'Update Review (updateStatus)',
        tags: ['Admin - Review'],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'string'))],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['status'],
                properties: [
            new OA\Property(property: 'status', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Updated successfully'),
            new OA\Response(response: 404, description: 'Not Found')
        ]
    )]
    public function updateStatus(UpdateReviewStatusRequest $request, string $id) {
        $review = $this->adminReviewService->updateReviewStatus($id, $request->validated('status'));
        return new AdminReviewResource($review);
    }
}
