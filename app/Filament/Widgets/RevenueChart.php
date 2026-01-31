<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RevenueChart extends ChartWidget
{
    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Transaction::where('status', 1)
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date')
            ->toArray();

        // Fill missing days with 0
        $days = [];
        $totals = [];
        $start = now()->startOfMonth();
        $end = now()->endOfMonth();

        for ($date = $start; $date->lte($end); $date->addDay()) {
            $dateString = $date->format('Y-m-d');
            $days[] = $date->format('d/m');
            $totals[] = $data[$dateString] ?? 0;

            if ($date->isToday()) break;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Doanh thu (VND)',
                    'data' => $totals,
                    'fill' => 'start',
                    'borderColor' => 'rgb(75, 192, 192)',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'tension' => 0.3,
                ],
            ],
            'labels' => $days,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
