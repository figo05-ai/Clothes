<?php
namespace App\Contracts\Analytics;
interface AnalyticsServiceInterface {
    public function getDashboardMetrics(): array;
}
