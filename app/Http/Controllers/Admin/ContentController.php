<?php
namespace App\Http\Controllers\Admin;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Content\AdminContentServiceInterface;
use App\Http\Requests\Admin\StorePageRequest;
use App\Http\Requests\Admin\StoreBannerRequest;
use App\Http\Resources\Content\PageResource;
use App\Http\Resources\Content\BannerResource;

class ContentController extends Controller {
    public function __construct(protected AdminContentServiceInterface $adminContentService) {}
    #[OA\Post(
        path: '/admin/api/pages',
        summary: 'Create/Process Content (storePage)',
        tags: ['Admin - Content'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['title', 'slug', 'content', 'is_active'],
                properties: [
            new OA\Property(property: 'title', type: 'string'),
            new OA\Property(property: 'slug', type: 'string'),
            new OA\Property(property: 'content', type: 'string'),
            new OA\Property(property: 'is_active', type: 'boolean')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Created successfully'),
            new OA\Response(response: 422, description: 'Validation Error')
        ]
    )]
    public function storePage(StorePageRequest $request) {
        return new PageResource($this->adminContentService->createPage($request->validated()));
    }
    #[OA\Post(
        path: '/admin/api/banners',
        summary: 'Create/Process Content (storeBanner)',
        tags: ['Admin - Content'],
                requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['title', 'image_url', 'link_url', 'order', 'is_active'],
                properties: [
            new OA\Property(property: 'title', type: 'string'),
            new OA\Property(property: 'image_url', type: 'string'),
            new OA\Property(property: 'link_url', type: 'string'),
            new OA\Property(property: 'order', type: 'integer'),
            new OA\Property(property: 'is_active', type: 'boolean')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Created successfully'),
            new OA\Response(response: 422, description: 'Validation Error')
        ]
    )]
    public function storeBanner(StoreBannerRequest $request) {
        return new BannerResource($this->adminContentService->createBanner($request->validated()));
    }
}
