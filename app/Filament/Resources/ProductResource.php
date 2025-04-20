<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Produk')->schema([
                    TextInput::make('name')
                        ->label('Nama Produk')
                        ->required()
                        ->maxLength(255)
                        ->reactive()
                        ->afterStateUpdated(function (?string $state, callable $set) {
                            if ($state) {
                                $set('slug', Str::slug($state));
                            }
                        }),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->maxLength(255)
                        ->disabled()
                        ->dehydrated()
                        ->unique(Product::class, 'slug', ignoreRecord: true),

                    MarkdownEditor::make('description')
                        ->label('Deskripsi')
                        ->columnSpanFull()
                        ->fileAttachmentsDirectory('products'),
                ])->columns(2),

                Section::make('Gambar')->schema([
                    FileUpload::make('images')
                        ->label('Unggah Gambar')
                        ->multiple()
                        ->directory('products')
                        ->maxFiles(5)
                        ->reorderable()
                ])->columnSpan(2),

                Section::make('Harga')->schema([
                    TextInput::make('price')
                        ->label('Harga')
                        ->numeric()
                        ->required()
                        ->prefix('Rp')
                ]),

                Section::make('Relasi')->schema([
                    Select::make('category_id')
                        ->label('Kategori')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship('category', 'name'),

                    Select::make('brand_id')
                        ->label('Merek')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship('brand', 'name'),
                ]),

                Section::make('Status')->schema([
                    Toggle::make('in_stock')
                        ->label('Stok Tersedia')
                        ->required()
                        ->default(true),

                    Toggle::make('is_active')
                        ->label('Aktif')
                        ->required()
                        ->default(true),

                    Toggle::make('is_featured')
                        ->label('Unggulan')
                        ->required(),

                    Toggle::make('on_sale')
                        ->label('Sedang Promo')
                        ->required(),
                ])
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable(),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable(),

                TextColumn::make('brand.name')
                    ->label('Merek')
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Harga')
                    ->formatStateUsing(fn ($state) => \App\Helpers\Number::currency($state))
                    ->sortable(),

                IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean(),

                IconColumn::make('on_sale')
                    ->label('Sedang Promo')
                    ->boolean(),

                IconColumn::make('in_stock')
                    ->label('Stok Tersedia')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),

                IconColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->boolean()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                IconColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->boolean()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->relationship('category', 'name'),

                SelectFilter::make('brand')
                    ->label('Merek')
                    ->relationship('brand', 'name'),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()->label('Lihat'),
                    EditAction::make()->label('Ubah'),
                    DeleteAction::make()->label('Hapus'),
                ])
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Hapus Terpilih'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Tambahkan relasi jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/buat'),
            'edit' => Pages\EditProduct::route('/{record}/ubah'),
        ];
    }
}
