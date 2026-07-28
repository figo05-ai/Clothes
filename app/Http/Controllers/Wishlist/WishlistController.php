<?php
namespace App\Http\Controllers\Wishlist;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Wishlist\WishlistServiceInterface;
use App\Http\Requests\Wishlist\ToggleWishlistRequest;
use App\Http\Resources\Wishlist\WishlistResource;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller {
    public function __construct(protected WishlistServiceInterface $wishlistService) {}

    #[OA\Get(
        path: '/api/wishlist',
        summary: 'Get list of Wishlists',
        tags: ['Customer - Wishlist'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index() {
        $wishlist = $this->wishlistService->getUserWishlist(Auth::id() ?? 'guest-id');
        return WishlistResource::collection($wishlist);
    }

    #[OA\Post(
        path: '/api/wishlist/toggle',
        summary: 'toggle operation',
        tags: ['Customer - Wishlist'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['product_id'],
                properties: [
            new OA\Property(property: 'product_id', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function toggle(ToggleWishlistRequest $request) {
        $result = $this->wishlistService->toggleWishlist(Auth::id() ?? 'guest-id', $request->validated('product_id'));
        return response()->json(['success' => true, 'action' => $result['status']]);
    }
}
