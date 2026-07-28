<?php
namespace App\Http\Controllers\Admin;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\RMA\AdminReturnServiceInterface;
use App\Http\Requests\Admin\UpdateReturnStatusRequest;
use App\Http\Resources\RMA\ReturnResource;

class ReturnController extends Controller {
    public function __construct(protected AdminReturnServiceInterface $adminReturnService) {}
    #[OA\Get(
        path: '/admin/api/returns',
        summary: 'Get list of Returns',
        tags: ['Admin - Return'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index() {
        return ReturnResource::collection($this->adminReturnService->getAllReturns());
    }
    #[OA\Put(
        path: '/admin/api/returns/{id}/status',
        summary: 'Update Return (updateStatus)',
        tags: ['Admin - Return'],
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
    public function updateStatus(UpdateReturnStatusRequest $request, string $id) {
        $returnReq = $this->adminReturnService->updateReturnStatus($id, $request->validated('status'));
        return new ReturnResource($returnReq);
    }
}
