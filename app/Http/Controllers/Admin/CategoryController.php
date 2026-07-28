<?php
namespace App\Http\Controllers\Admin;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Catalog\CategoryManagementServiceInterface;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Http\Resources\Admin\AdminCategoryResource;

class CategoryController extends Controller {
    public function __construct(protected CategoryManagementServiceInterface $categoryService) {}

    #[OA\Get(
        path: '/admin/api/categories',
        summary: 'Get list of Categorys',
        tags: ['Admin - Category'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index() {
        return AdminCategoryResource::collection($this->categoryService->getAllCategories());
    }
    #[OA\Post(
        path: '/admin/api/categories',
        summary: 'Create/Process Category (store)',
        tags: ['Admin - Category'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'slug', 'icon'],
                properties: [
            new OA\Property(property: 'name', type: 'string'),
            new OA\Property(property: 'slug', type: 'string'),
            new OA\Property(property: 'icon', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Created successfully'),
            new OA\Response(response: 422, description: 'Validation Error')
        ]
    )]
    public function store(StoreCategoryRequest $request) {
        $category = $this->categoryService->createCategory($request->validated());
        return new AdminCategoryResource($category);
    }
    #[OA\Put(
        path: '/admin/api/categories/{id}',
        summary: 'Update Category (update)',
        tags: ['Admin - Category'],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'string'))],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name', 'slug', 'icon'],
                properties: [
            new OA\Property(property: 'name', type: 'string'),
            new OA\Property(property: 'slug', type: 'string'),
            new OA\Property(property: 'icon', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Updated successfully'),
            new OA\Response(response: 404, description: 'Not Found')
        ]
    )]
    public function update(UpdateCategoryRequest $request, string $id) {
        $category = $this->categoryService->updateCategory($id, $request->validated());
        return new AdminCategoryResource($category);
    }
    #[OA\Delete(
        path: '/admin/api/categories/{id}',
        summary: 'Delete Category',
        tags: ['Admin - Category'],
        parameters: [new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'string'))],
        responses: [
            new OA\Response(response: 204, description: 'Deleted successfully'),
            new OA\Response(response: 404, description: 'Not Found')
        ]
    )]
    public function destroy(string $id) {
        $this->categoryService->deleteCategory($id);
        return response()->json(['success' => true]);
    }
}
