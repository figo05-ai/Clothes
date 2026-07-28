<?php
namespace App\Http\Controllers\Admin;

use OpenApi\Attributes as OA;




use App\Http\Controllers\Controller;
use App\Contracts\Discount\CouponManagementServiceInterface;
use App\Http\Requests\Admin\StoreCouponRequest;
use App\Http\Resources\Admin\AdminCouponResource;

class CouponController extends Controller {
    public function __construct(protected CouponManagementServiceInterface $couponService) {}

    #[OA\Get(
        path: '/admin/api/coupons',
        summary: 'Get list of Coupons',
        tags: ['Admin - Coupon'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index() {
        return AdminCouponResource::collection($this->couponService->getAllCoupons());
    }

    #[OA\Post(
        path: '/admin/api/coupons',
        summary: 'Create/Process Coupon (store)',
        tags: ['Admin - Coupon'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['code', 'type', 'value', 'usage_limit', 'valid_until'],
                properties: [
            new OA\Property(property: 'code', type: 'string'),
            new OA\Property(property: 'type', type: 'string'),
            new OA\Property(property: 'value', type: 'integer'),
            new OA\Property(property: 'usage_limit', type: 'integer'),
            new OA\Property(property: 'valid_until', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Created successfully'),
            new OA\Response(response: 422, description: 'Validation Error')
        ]
    )]
    public function store(StoreCouponRequest $request) {
        $coupon = $this->couponService->createCoupon($request->validated());
        return new AdminCouponResource($coupon);
    }

    #[OA\Delete(
        path: '/admin/api/coupons/{id}',
        summary: 'Delete Coupon',
        tags: ['Admin - Coupon'],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'string'))],
        responses: [
            new OA\Response(response: 204, description: 'Deleted successfully'),
            new OA\Response(response: 404, description: 'Not Found')
        ]
    )]
    public function destroy(string $id) {
        $this->couponService->deleteCoupon($id);
        return response()->json(['success' => true]);
    }
}
