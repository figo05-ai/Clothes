<?php

namespace App\Http\Controllers\Payment;

use OpenApi\Attributes as OA;




use App\Http\Controllers\Controller;
use App\Contracts\Payment\PaymentGatewayInterface;
use App\Http\Requests\Payment\PaymentCallbackRequest;
use App\Http\Resources\Payment\PaymentUrlResource;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct(
        protected PaymentGatewayInterface $paymentGateway
    ) {}

    /**
     * Generate a payment link for a specific order.
     */
    #[OA\Post(
        path: '/api/payments/{orderId}/generate',
        summary: 'generate operation',
        tags: ['Customer - Payment'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function generate(Request $request, string $orderId)
    {
        $order = Order::findOrFail($orderId);
        
        $url = $this->paymentGateway->generatePaymentUrl(
            $order->id,
            $order->grand_total,
            ['user_id' => $order->user_id]
        );

        return new PaymentUrlResource($url);
    }

    /**
     * Handle incoming webhooks from the payment gateway.
     */
    #[OA\Post(
        path: '/api/payments/webhook',
        summary: 'webhook operation',
        tags: ['Customer - Payment'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['type', 'data', 'data.object', 'data.object.id'],
                properties: [
            new OA\Property(property: 'type', type: 'string'),
            new OA\Property(property: 'data', type: 'array', items: new OA\Items(type: 'string')),
            new OA\Property(property: 'data.object', type: 'array', items: new OA\Items(type: 'string')),
            new OA\Property(property: 'data.object.id', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function webhook(PaymentCallbackRequest $request)
    {
        $signature = $request->header('Stripe-Signature', '');
        
        if (!$this->paymentGateway->verifyWebhook($request->all(), $signature)) {
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        // Dummy processing logic
        $type = $request->input('type');
        Log::info("Received payment webhook: {$type}");

        if ($type === 'checkout.session.completed') {
            // Update order status, create transaction record, etc.
        }

        return response()->json(['status' => 'success'], 200);
    }
}
