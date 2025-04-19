<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        $total = Order::query()->sum('grand_total') ?? 0;

        return [
            Stat::make('Pesanan Baru', Order::query()->where('status', 'new')->count()),
            Stat::make('Sedang Diproses', Order::query()->where('status', 'processing')->count()),
            Stat::make('Pesanan Dikirim', Order::query()->where('status', 'shipped')->count()),
            Stat::make('Total Pendapatan', 'Rp ' . number_format($total, 0, ',', '.')),
        ];
    }
}


