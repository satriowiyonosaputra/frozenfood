<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers\AddressRelationManager;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Informasi Pesanan')->schema([
                        Select::make('user_id')
                            ->label('Pelanggan')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->options([
                                'stripe' => 'Stripe',
                                'cod' => 'Bayar di Tempat',
                            ])
                            ->required(),

                        Select::make('payment_status')
                            ->label('Status Pembayaran')
                            ->options([
                                'pending' => 'Menunggu',
                                'paid' => 'Lunas',
                                'failed' => 'Gagal',
                            ])
                            ->default('pending')
                            ->required(),

                        ToggleButtons::make('status')
                            ->label('Status Pesanan')
                            ->inline()
                            ->default('new')
                            ->required()
                            ->options([
                                'new' => 'Baru',
                                'processing' => 'Sedang Diproses',
                                'shipped' => 'Dikirim',
                                'delivered' => 'Terkirim',
                                'cancelled' => 'Dibatalkan',
                            ])
                            ->colors([
                                'new' => 'info',
                                'processing' => 'warning',
                                'shipped' => 'success',
                                'delivered' => 'success',
                                'cancelled' => 'danger',
                            ])
                            ->icons([
                                'new' => 'heroicon-m-sparkles',
                                'processing' => 'heroicon-m-arrow-path',
                                'shipped' => 'heroicon-m-truck',
                                'delivered' => 'heroicon-m-check-badge',
                                'cancelled' => 'heroicon-m-x-circle',
                            ]),

                        Select::make('currency')
                            ->label('Mata Uang')
                            ->options([
                                'idr' => 'IDR',
                                'usd' => 'USD',
                                'eur' => 'EUR',
                                'gbp' => 'GBP',
                                'rp'  => 'RP',
                            ])
                            ->default('idr')
                            ->required(),

                        Select::make('shipping_method')
                            ->label('Metode Pengiriman')
                            ->options([
                                'fedex' => 'FedEx',
                                'ups' => 'UPS',
                                'dhl' => 'DHL',
                                'usps' => 'USPS',
                            ]),

                        Textarea::make('notes')
                            ->label('Catatan')
                            ->columnSpanFull(),
                    ])->columns(2),

                    Section::make('Item Pesanan')->schema([
                        Repeater::make('items')
                            ->label('Daftar Item')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->label('Produk')
                                    ->relationship('product', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->distinct()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->columnSpan(4)
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, $set) {
                                        $product = Product::find($state);
                                        $price = $product ? $product->price : 0;
                                        $set('unit_amount', $price);
                                        $set('total_amount', $price);
                                    }),

                                TextInput::make('quantity')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->required()
                                    ->default(1)
                                    ->minValue(1)
                                    ->columnSpan(2)
                                    ->live()
                                    ->afterStateUpdated(function ($state, $set, $get) {
                                        $set('total_amount', $state * $get('unit_amount'));
                                    }),

                                TextInput::make('unit_amount')
                                    ->label('Harga Satuan')
                                    ->numeric()
                                    ->required()
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(3),

                                TextInput::make('total_amount')
                                    ->label('Total')
                                    ->numeric()
                                    ->required()
                                    ->dehydrated()
                                    ->columnSpan(3),
                            ])
                            ->columns(12)
                            ->afterStateUpdated(function ($set, $get) {
                                $total = 0;
                                foreach ($get('items') ?? [] as $item) {
                                    $total += $item['total_amount'] ?? 0;
                                }
                                $set('grand_total', $total);
                            }),

                        Placeholder::make('grand_total_placeholder')
                            ->label('Total Keseluruhan')
                            ->content(function ($get, $set) {
                                $total = 0;
                                foreach ($get('items') ?? [] as $item) {
                                    $total += $item['total_amount'] ?? 0;
                                }
                                $set('grand_total', $total);
                                return 'Rp ' . number_format($total, 0, ',', '.');
                            }),

                        Placeholder::make('total_sales_placeholder')
                            ->label('Total Harga Item')
                            ->content(function ($get) {
                                $totalSales = 0;
                                foreach ($get('items') ?? [] as $item) {
                                    $unit = $item['unit_amount'] ?? 0;
                                    $qty = $item['quantity'] ?? 0;
                                    $totalSales += $unit * $qty;
                                }
                                return 'Rp ' . number_format($totalSales, 0, ',', '.');
                            }),

                        Hidden::make('grand_total')->default(0),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Pelanggan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('grand_total')
                    ->label('Total')
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        return 'Rp ' . number_format($state, 0, ',', '.');
                    }),

                TextColumn::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->label('Status Pembayaran')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('currency')
                    ->label('Mata Uang')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('shipping_method')
                    ->label('Metode Pengiriman')
                    ->searchable()
                    ->sortable(),

                SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'new' => 'Baru',
                        'processing' => 'Sedang Diproses',
                        'shipped' => 'Dikirim',
                        'delivered' => 'Terkirim',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->searchable()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AddressRelationManager::class,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'danger' : 'success';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),  // Perbaikan ada di sini
        ];
    }
}
