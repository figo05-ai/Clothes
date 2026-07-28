<?php
namespace App\Http\Controllers\Admin;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Shipping\AdminShippingServiceInterface;
use App\Http\Requests\Admin\CreateShipmentRequest;
use App\Http\Requests\Admin\UpdateShipmentStatusRequest;
use App\Http\Resources\Shipping\ShipmentResource;

class ShippingController extends Controller {
    public function __construct(protected AdminShippingServiceInterface $adminShippingService) {}
    #[OA\Post(
        path: '/admin/api/shipping',
        summary: 'Create/Process Shipping (store)',
        tags: ['Admin - Shipping'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['order_id', 'tracking_number', 'carrier'],
                properties: [
            new OA\Property(property: 'order_id', type: 'string'),
            new OA\Property(property: 'tracking_number', type: 'string'),
            new OA\Property(property: 'carrier', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Created successfully'),
            new OA\Response(response: 422, description: 'Validation Error')
        ]
    )]
    public function store(CreateShipmentRequest $request) {
        $shipment = $this->adminShippingService->createShipment($request->validated('order_id'), $request->validated());
        return new ShipmentResource($shipment);
    }
    #[OA\Put(
        path: '/admin/api/shipping/{id}/status',
        summary: 'Update Shipping (updateStatus)',
        tags: ['Admin - Shipping'],
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
    public function updateStatus(UpdateShipmentStatusRequest $request, string $trackingNumber) {
        $shipment = $this->adminShippingService->updateShipmentStatus($trackingNumber, $request->validated('status'));
        return new ShipmentResource($shipment);
    }
}
