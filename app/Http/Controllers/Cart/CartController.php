<?php

namespace App\Http\Controllers\Cart;

use OpenApi\Attributes as OA;




use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Resources\Cart\CartResource;
use App\Contracts\Cart\CartServiceInterface;

class CartController extends Controller
{
    public function __construct(
        protected CartServiceInterface $cartService
    ) {}

    /**
     * Display the cart contents.
     */
    #[OA\Get(
        path: '/api/cart',
        summary: 'Get list of Carts',
        tags: ['Customer - Cart'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index()
    {
        $cart = $this->cartService->getCart();
        return new CartResource($cart);
    }

    /**
     * Add a product to the cart.
     */
    #[OA\Post(
        path: '/api/cart',
        summary: 'Create/Process Cart (store)',
        tags: ['Customer - Cart'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['product_id', 'quantity'],
                properties: [
            new OA\Property(property: 'product_id', type: 'string'),
            new OA\Property(property: 'quantity', type: 'integer')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Created successfully'),
            new OA\Response(response: 422, description: 'Validation Error')
        ]
    )]
    public function store(AddToCartRequest $request)
    {
        $cart = $this->cartService->add(
            $request->validated('product_id'),
            $request->validated('quantity')
        );

        return new CartResource($cart);
    }

    /**
     * Remove a product from the cart.
     */
    #[OA\Delete(
        path: '/api/cart/{productId}',
        summary: 'Remove item from Cart',
        tags: ['Customer - Cart'],
        parameters: [
            new OA\Parameter(name: 'productId', in: 'path', required: true, description: 'Product ID')
        ],
        responses: [
            new OA\Response(response: 200, description: 'Removed successfully')
        ]
    )]
    public function destroy(string $productId)
    {
        $cart = $this->cartService->remove($productId);
        return new CartResource($cart);
    }
}
