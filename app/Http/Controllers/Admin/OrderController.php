<?php
namespace App\Http\Controllers\Admin;

use OpenApi\Attributes as OA;




use App\Http\Controllers\Controller;
use App\Contracts\Order\AdminOrderServiceInterface;
use App\Http\Requests\Admin\UpdateOrderStatusRequest;
use App\Http\Resources\Admin\AdminOrderResource;

class OrderController extends Controller {
    public function __construct(protected AdminOrderServiceInterface $orderService) {}

    #[OA\Get(
        path: '/admin/api/orders',
        summary: 'Get list of Orders',
        tags: ['Admin - Order'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index() {
        $orders = $this->orderService->getAllOrders();
        return AdminOrderResource::collection($orders);
    }

    #[OA\Get(
        path: '/admin/api/orders/{id}',
        summary: 'Get specific Order',
        tags: ['Admin - Order'],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'string'))],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 404, description: 'Not Found')
        ]
    )]
    public function show(string $id) {
        $order = $this->orderService->getOrderDetails($id);
        return new AdminOrderResource($order);
    }

    #[OA\Put(
        path: '/admin/api/orders/{id}/status',
        summary: 'Update Order (updateStatus)',
        tags: ['Admin - Order'],
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
    public function updateStatus(UpdateOrderStatusRequest $request, string $id) {
        $order = $this->orderService->updateOrderStatus($id, $request->validated('status'));
        return new AdminOrderResource($order);
    }
}
