<?php
namespace App\Http\Controllers\Admin;

use OpenApi\Attributes as OA;




use App\Http\Controllers\Controller;
use App\Contracts\Product\ProductManagementServiceInterface;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Http\Resources\Admin\AdminProductResource;

class ProductController extends Controller {
    public function __construct(protected ProductManagementServiceInterface $productService) {}

    #[OA\Get(
        path: '/admin/api/products',
        summary: 'Get list of Products',
        tags: ['Admin - Product'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index() {
        return AdminProductResource::collection($this->productService->getAllProducts());
    }

    #[OA\Post(
        path: '/admin/api/products',
        summary: 'Create/Process Product (store)',
        tags: ['Admin - Product'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'base_price', 'stock_quantity', 'subcategory_id', 'slug', 'sku', 'short_description', 'long_description'],
                properties: [
            new OA\Property(property: 'name', type: 'string'),
            new OA\Property(property: 'base_price', type: 'integer'),
            new OA\Property(property: 'stock_quantity', type: 'integer'),
            new OA\Property(property: 'subcategory_id', type: 'string'),
            new OA\Property(property: 'slug', type: 'string'),
            new OA\Property(property: 'sku', type: 'string'),
            new OA\Property(property: 'short_description', type: 'string'),
            new OA\Property(property: 'long_description', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Created successfully'),
            new OA\Response(response: 422, description: 'Validation Error')
        ]
    )]
    public function store(StoreProductRequest $request) {
        $product = $this->productService->createProduct($request->validated());
        return new AdminProductResource($product);
    }

    #[OA\Put(
        path: '/admin/api/products/{id}',
        summary: 'Update Product (update)',
        tags: ['Admin - Product'],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'string'))],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'base_price', 'stock_quantity', 'category_id'],
                properties: [
            new OA\Property(property: 'name', type: 'string'),
            new OA\Property(property: 'base_price', type: 'integer'),
            new OA\Property(property: 'stock_quantity', type: 'integer'),
            new OA\Property(property: 'category_id', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Updated successfully'),
            new OA\Response(response: 404, description: 'Not Found')
        ]
    )]
    public function update(UpdateProductRequest $request, string $id) {
        $product = $this->productService->updateProduct($id, $request->validated());
        return new AdminProductResource($product);
    }

    #[OA\Delete(
        path: '/admin/api/products/{id}',
        summary: 'Delete Product',
        tags: ['Admin - Product'],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'string'))],
        responses: [
            new OA\Response(response: 204, description: 'Deleted successfully'),
            new OA\Response(response: 404, description: 'Not Found')
        ]
    )]
    public function destroy(string $id) {
        $this->productService->deleteProduct($id);
        return response()->json(['success' => true]);
    }
}
