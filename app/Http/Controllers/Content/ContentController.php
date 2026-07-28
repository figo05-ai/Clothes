<?php
namespace App\Http\Controllers\Content;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Content\ContentServiceInterface;
use App\Http\Resources\Content\PageResource;
use App\Http\Resources\Content\BannerResource;

class ContentController extends Controller {
    public function __construct(protected ContentServiceInterface $contentService) {}
    #[OA\Post(
        path: '/api/banners',
        summary: 'banners operation',
        tags: ['Customer - Content'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function banners() {
        return BannerResource::collection($this->contentService->getActiveBanners());
    }
    #[OA\Post(
        path: '/api/pages/{slug}',
        summary: 'page operation',
        tags: ['Customer - Content'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function page(string $slug) {
        return new PageResource($this->contentService->getPageBySlug($slug));
    }
}
