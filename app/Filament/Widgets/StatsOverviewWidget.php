<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Revenue', '$' . number_format(\App\Models\Order::where('status', 'delivered')->sum('grand_total'), 2))
                ->description('Delivered orders revenue')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Orders', \App\Models\Order::count())
                ->description('All time orders')
                ->descriptionIcon('heroicon-m-shopping-cart'),
            Stat::make('Total Customers', \App\Models\User::whereHas('roles', fn ($q) => $q->where('name', 'customer'))->count())
                ->description('Registered customers')
                ->descriptionIcon('heroicon-m-users'),
        ];
    }
}
