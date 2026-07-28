<?php
namespace App\Http\Controllers\Admin;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Inventory\AdminInventoryServiceInterface;
use App\Http\Requests\Admin\AdjustStockRequest;
use App\Http\Resources\Admin\AdminInventoryResource;
use Illuminate\Http\Request;

class InventoryController extends Controller {
    public function __construct(protected AdminInventoryServiceInterface $adminInventoryService) {}
    #[OA\Post(
        path: '/admin/api/inventory/low-stock',
        summary: 'lowStock operation',
        tags: ['Admin - Inventory'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function lowStock(Request $request) {
        $threshold = $request->query('threshold', 10);
        return AdminInventoryResource::collection($this->adminInventoryService->getLowStockProducts($threshold));
    }
    #[OA\Put(
        path: '/admin/api/inventory/{id}/adjust',
        summary: 'Update Inventory (adjust)',
        tags: ['Admin - Inventory'],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'string'))],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['quantity', 'reason'],
                properties: [
            new OA\Property(property: 'quantity', type: 'integer'),
            new OA\Property(property: 'reason', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Updated successfully'),
            new OA\Response(response: 404, description: 'Not Found')
        ]
    )]
    public function adjust(AdjustStockRequest $request, string $productId) {
        $product = $this->adminInventoryService->adjustStock($productId, $request->validated('quantity'), $request->validated('reason'));
        return new AdminInventoryResource($product);
    }
}
