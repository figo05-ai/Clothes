<?php
namespace App\Services\Analytics;
use App\Contracts\Analytics\AnalyticsServiceInterface;
use App\Models\Order;
use App\Models\User;

class AnalyticsService implements AnalyticsServiceInterface {
    public function getDashboardMetrics(): array {
        return [
            'total_sales' => Order::where('status', '!=', 'cancelled')->sum('total_amount'),
            'total_orders' => Order::count(),
            'total_users' => User::count(),
        ];
    }
}
