<?php
namespace App\Http\Controllers\Product;

use OpenApi\Attributes as OA;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductFilterRequest;
use App\Http\Resources\Product\ProductResource;
use App\Contracts\Product\ProductFilterServiceInterface;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct(
        protected ProductFilterServiceInterface $productService
    ) {}

    /**
     * Display a listing of filtered products.
     */
    #[OA\Get(
        path: '/api/products',
        summary: 'Get list of Products',
        tags: ['Customer - Product'],
        parameters: [
        new OA\Parameter(name: 'search', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'category_id', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'subcategory_id', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'color', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'size', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'min_price', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        new OA\Parameter(name: 'max_price', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        new OA\Parameter(name: 'sort_by', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'sort_direction', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),

        new OA\Parameter(name: 'search', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'category_id', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'subcategory_id', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'color', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'size', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'min_price', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        new OA\Parameter(name: 'max_price', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        new OA\Parameter(name: 'sort_by', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'sort_direction', in: 'query', required: false, schema: new OA\Schema(type: 'string')),
        new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index(ProductFilterRequest $request)
    {
        $perPage = $request->input('per_page', 15);

        $products = $this->productService->getFilteredProducts(
            $request->validated(),
            $perPage
        );

        return ProductResource::collection($products);
    }

    #[OA\Get(
        path: '/api/products/{id}',
        summary: 'Get specific Product',
        tags: ['Customer - Product'],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'string'))],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 404, description: 'Not Found')
        ]
    )]
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }
}
