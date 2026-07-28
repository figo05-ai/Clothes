<?php
namespace App\Http\Controllers\Catalog;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Catalog\CategoryManagementServiceInterface;
use App\Http\Resources\Catalog\CategoryResource;

class CategoryController extends Controller {
    public function __construct(protected CategoryManagementServiceInterface $categoryService) {}

    #[OA\Get(
        path: '/api/categories',
        summary: 'Get list of Categorys',
        tags: ['Customer - Category'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index() {
        return CategoryResource::collection($this->categoryService->getAllCategories());
    }
    #[OA\Get(
        path: '/api/categories/{id}',
        summary: 'Get specific Category',
        tags: ['Customer - Category'],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'string'))],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 404, description: 'Not Found')
        ]
    )]
    public function show(string $id) {
        return new CategoryResource($this->categoryService->getCategoryDetails($id));
    }
}
