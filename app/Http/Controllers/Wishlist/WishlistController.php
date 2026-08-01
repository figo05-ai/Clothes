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
        $action = $result['status'];
        $message = $action === 'added' ? 'Added to Wishlist successfully.' : 'Removed from Wishlist.';
        
        $productData = null;
        if ($action === 'added') {
            $product = \App\Models\Product::with('images')->find($request->validated('product_id'));
            if ($product) {
                $image = $product->images->where('is_primary', true)->first();
                if (!$image && $product->images->count() > 0) {
                    $image = $product->images->first();
                }
                $imageUrl = $image ? $image->image_url : 'https://placehold.co/400x400?text=No+Image';
                $productData = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => number_format($product->base_price, 2),
                    'image' => $imageUrl
                ];
            }
        }

        return response()->json(['success' => true, 'action' => $action, 'message' => $message, 'product' => $productData]);
    }
}
