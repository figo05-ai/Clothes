<?php
namespace App\Http\Controllers\RMA;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\RMA\ReturnServiceInterface;
use App\Http\Requests\RMA\CreateReturnRequest;
use App\Http\Resources\RMA\ReturnResource;
use Illuminate\Support\Facades\Auth;

class ReturnController extends Controller {
    public function __construct(protected ReturnServiceInterface $returnService) {}
    #[OA\Get(
        path: '/api/returns',
        summary: 'Get list of Returns',
        tags: ['Customer - Return'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index() {
        return ReturnResource::collection($this->returnService->getUserReturns(Auth::id() ?? 'guest'));
    }
    #[OA\Post(
        path: '/api/returns',
        summary: 'Create/Process Return (store)',
        tags: ['Customer - Return'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['reason'],
                properties: [
            new OA\Property(property: 'reason', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Created successfully'),
            new OA\Response(response: 422, description: 'Validation Error')
        ]
    )]
    public function store(CreateReturnRequest $request) {
        $returnReq = $this->returnService->createReturn(Auth::id() ?? 'guest', $request->validated());
        return new ReturnResource($returnReq);
    }
}
