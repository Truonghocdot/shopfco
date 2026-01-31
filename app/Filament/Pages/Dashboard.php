<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LatestTransactions;
use App\Filament\Widgets\RevenueChart;
use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            RevenueChart::class,
            LatestTransactions::class,
        ];
    }
}
