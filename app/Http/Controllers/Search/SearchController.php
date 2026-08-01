<?php
namespace App\Http\Controllers\Search;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Search\SearchServiceInterface;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;

class SearchController extends Controller {
    public function __construct(protected SearchServiceInterface $searchService) {}
    #[OA\Post(
        path: '/api/search',
        summary: 'search operation',
        tags: ['Customer - Search'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function search(Request $request) {
        $query = $request->query('q', '');
        return ProductResource::collection($this->searchService->searchProducts($query));
    }
}
