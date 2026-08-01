<?php
namespace App\Http\Controllers\Admin;

use OpenApi\Attributes as OA;



use App\Http\Controllers\Controller;
use App\Contracts\Analytics\AnalyticsServiceInterface;

class AnalyticsController extends Controller {
    public function __construct(protected AnalyticsServiceInterface $analyticsService) {}
    #[OA\Get(
        path: '/admin/api/analytics/dashboard',
        summary: 'Get list of Analyticss',
        tags: ['Admin - Analytics'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function index() {
        return response()->json($this->analyticsService->getDashboardMetrics());
    }
}
