<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InventoryValueStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $products = Product::all();
        $totalProduct = $products->sum(function($product) { 
            return $product->stock;
        });

        $InvValue = $products->sum(function($product) use($totalProduct) {
            return $product->price * $totalProduct;
        });
        return [
            Stat::make('Inventory Value', '$' . number_format($InvValue, 2)),
        ];
    }
}
