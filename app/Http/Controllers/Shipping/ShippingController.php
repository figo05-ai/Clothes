<?php
namespace App\Http\Controllers\Shipping;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Shipping\ShippingServiceInterface;
use App\Http\Resources\Shipping\ShipmentResource;

class ShippingController extends Controller {
    public function __construct(protected ShippingServiceInterface $shippingService) {}
    #[OA\Post(
        path: '/api/shipping/track/{trackingNumber}',
        summary: 'track operation',
        tags: ['Customer - Shipping'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function track(string $trackingNumber) {
        return new ShipmentResource($this->shippingService->trackShipment($trackingNumber));
    }
}
