<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class TotalProductStatsOverview extends ChartWidget
{
    protected static ?string $heading = 'Total Products';

    protected function getData(): array
    {
        $data = Trend::model(Product::class)
        ->between(
            start: now()->startOfYear(),
            end: now(),
        )
        ->perMonth()
        ->count();

        // dd($data);

        return [
            'datasets' => [
                [
                    'label' => 'Products Created',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
 
    protected function getType(): string
    {
        return 'line';
    }
}