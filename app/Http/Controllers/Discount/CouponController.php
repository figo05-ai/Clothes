<?php

namespace App\Http\Controllers\Discount;

use OpenApi\Attributes as OA;




use App\Http\Controllers\Controller;
use App\Http\Requests\Discount\ApplyCouponRequest;
use App\Contracts\Discount\DiscountServiceInterface;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct(
        protected DiscountServiceInterface $discountService
    ) {}

    /**
     * Apply a coupon code.
     */
    #[OA\Post(
        path: '/api/coupons/apply',
        summary: 'apply operation',
        tags: ['Customer - Coupon'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['code'],
                properties: [
            new OA\Property(property: 'code', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function apply(ApplyCouponRequest $request)
    {
        $result = $this->discountService->applyCoupon($request->validated('code'));

        if (!$result['success']) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }

        return response()->json(['success' => true, 'message' => $result['message']], 200);
    }

    /**
     * Remove the applied coupon.
     */
    #[OA\Post(
        path: '/api/coupons/remove',
        summary: 'remove operation',
        tags: ['Customer - Coupon'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function remove()
    {
        $result = $this->discountService->removeCoupon();
        return response()->json($result, 200);
    }
}
