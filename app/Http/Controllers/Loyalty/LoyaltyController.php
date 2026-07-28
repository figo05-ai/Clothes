<?php
namespace App\Http\Controllers\Loyalty;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Loyalty\LoyaltyServiceInterface;
use App\Http\Requests\Loyalty\RedeemPointsRequest;
use App\Http\Resources\Loyalty\LoyaltyResource;
use Illuminate\Support\Facades\Auth;

class LoyaltyController extends Controller {
    public function __construct(protected LoyaltyServiceInterface $loyaltyService) {}
    
    #[OA\Post(
        path: '/api/loyalty/balance',
        summary: 'balance operation',
        tags: ['Customer - Loyalty'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function balance() {
        $points = $this->loyaltyService->getBalance(Auth::id() ?? 'guest');
        return new LoyaltyResource($points);
    }
    
    #[OA\Post(
        path: '/api/loyalty/redeem',
        summary: 'redeem operation',
        tags: ['Customer - Loyalty'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['points'],
                properties: [
            new OA\Property(property: 'points', type: 'integer')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function redeem(RedeemPointsRequest $request) {
        $discountAmount = $this->loyaltyService->redeemPoints(Auth::id() ?? 'guest', $request->validated('points'));
        if ($discountAmount > 0) {
            return response()->json(['success' => true, 'discount_amount' => $discountAmount]);
        }
        return response()->json(['success' => false, 'message' => 'Insufficient points.'], 400);
    }
}
