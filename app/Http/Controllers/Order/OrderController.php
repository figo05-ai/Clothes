<?php

namespace App\Http\Controllers\Order;

use OpenApi\Attributes as OA;




use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CheckoutRequest;
use App\Http\Resources\Order\OrderResource;
use App\Contracts\Order\OrderServiceInterface;
use Illuminate\Support\Facades\Auth;
use Exception;

class OrderController extends Controller
{
    public function __construct(
        protected OrderServiceInterface $orderService
    ) {}

    /**
     * Checkout the cart and create an order.
     */
    /**
     * Get order history.
     */
    #[OA\Get(
        path: '/api/orders',
        summary: 'Get order history',
        tags: ['Customer - Order'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function index()
    {
        $orders = \App\Models\Order::where('user_id', Auth::id())->latest()->paginate(15);
        return OrderResource::collection($orders);
    }

    #[OA\Post(
        path: '/api/checkout',
        summary: 'Create/Process Order (checkout)',
        tags: ['Customer - Order'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['shipping_address', 'billing_address', 'payment_method', 'shipping_cost', 'tax_amount'],
                properties: [
            new OA\Property(property: 'shipping_address', type: 'string'),
            new OA\Property(property: 'billing_address', type: 'string'),
            new OA\Property(property: 'payment_method', type: 'string'),
            new OA\Property(property: 'shipping_cost', type: 'integer'),
            new OA\Property(property: 'tax_amount', type: 'integer')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Created successfully'),
            new OA\Response(response: 422, description: 'Validation Error')
        ]
    )]
    public function checkout(CheckoutRequest $request)
    {
        try {
            $order = $this->orderService->checkout(
                $request->validated(),
                Auth::id()
            );

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully.',
                'data' => new OrderResource($order)
            ], 201);
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get order details.
     */
    #[OA\Get(
        path: '/api/orders/{id}',
        summary: 'Get specific Order',
        tags: ['Customer - Order'],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'string'))],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 404, description: 'Not Found')
        ]
    )]
    public function show(string $id)
    {
        $order = $this->orderService->getOrderDetails($id);
        return new OrderResource($order);
    }
}
