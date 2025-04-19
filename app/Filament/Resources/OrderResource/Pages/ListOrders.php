<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use Filament\Resources\Components\Tab;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'new' => Tab::make('New')->modifyQueryUsing(fn($query) => $query->where('status', 'new')),
            'processing' => Tab::make('Processing')->modifyQueryUsing(fn($query) => $query->where('status', 'processing')),
            'shipped' => Tab::make('Shipped')->modifyQueryUsing(fn($query) => $query->where('status', 'shipped')),
            'delivered' => Tab::make('Delivered')->modifyQueryUsing(fn($query) => $query->where('status', 'delivered')),
            'cancelled' => Tab::make('Cancelled')->modifyQueryUsing(fn($query) => $query->where('status', 'cancelled')),
        ];
    }
}
