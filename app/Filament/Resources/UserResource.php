<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema(self::getFormSchema());
    }

    protected static function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label('Nama Pengguna')
                ->required(),

            Forms\Components\TextInput::make('email')
                ->label('Alamat Email')
                ->email()
                ->maxlength(255)
                ->unique(ignoreRecord: true)
                ->required(),

                Forms\Components\DateTimePicker::make('email_verified_at')
                ->label('Email Diverifikasi Pada')
                ->nullable()
                ->default(now()),

            Forms\Components\TextInput::make('password')
                ->label('Kata Sandi')
                ->password()
                ->dehydrated(fn($state) => filled($state)) // hanya disimpan jika diisi
                ->required(fn($livewire) => $livewire instanceof Pages\CreateUser)
                ->afterStateHydrated(function ($component, $state) {
                    // Kosongkan field saat edit agar tidak tampil hash
                    $component->state('');
                })
                ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(self::getTableColumns())
            ->filters(self::getTableFilters())
            ->actions(self::getTableActions())
            ->bulkActions(self::getBulkActions());
    }

    protected static function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label('Nama Pengguna')
                ->searchable(),

            Tables\Columns\TextColumn::make('email')
                ->label('Alamat Email')
                ->searchable(),

            Tables\Columns\TextColumn::make('email_verified_at')
                ->label('Email Diverifikasi Pada')
                ->dateTime()
                ->sortable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Dibuat Pada')
                ->dateTime()
                ->sortable(),
        ];
    }

    protected static function getTableFilters(): array
    {
        return [];
    }

    protected static function getTableActions(): array
    {
        return [
            Tables\Actions\ActionGroup::make([
                Tables\Actions\ViewAction::make()->label('Lihat'),
                Tables\Actions\EditAction::make()->label('Ubah'),
                Tables\Actions\DeleteAction::make()->label('Hapus'),
            ]),
        ];
    }

    protected static function getBulkActions(): array
    {
        return [
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make()->label('Hapus Terpilih'),
            ]),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\OrdersRelationManager::class,
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email'];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/buat'),
            'edit' => Pages\EditUser::route('/{record}/ubah'),
        ];
    }
}
