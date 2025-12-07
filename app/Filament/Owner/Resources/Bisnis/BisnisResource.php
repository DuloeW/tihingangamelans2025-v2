<?php

namespace App\Filament\Owner\Resources;

use App\Filament\Owner\Resources\Bisnis\Pages\CreateBisnis as PagesCreateBisnis;
use App\Filament\Owner\Resources\Bisnis\Pages\EditBisnis as PagesEditBisnis;
use App\Filament\Owner\Resources\Bisnis\Pages\ListBisnis as PagesListBisnis;
use App\Models\Bisnis;

use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder; 
use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Placeholder; 
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Schemas\Components\Utilities\Set as UtilitiesSet;

class BisnisResource extends Resource
{
    protected static ?string $model = Bisnis::class;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationLabel = 'Bisnis Saya';

   
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('owner_id', auth()->id());
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. OWNER ID (Otomatis ambil user login)
                Hidden::make('owner_id')
                    ->default(fn () => auth()->id())
                    ->required(),

                // 2. STATUS (Otomatis Unverified saat Create)
                Hidden::make('status')
                    ->default('un_verified'),

                // 3. INFO STATUS (Agar owner tau statusnya apa)
                Placeholder::make('status_info')
                    ->label('Status Bisnis Anda')
                    ->content(fn ($record) => $record ? strtoupper($record->status) : 'DRAFT (Akan ditinjau Admin)')
                    ->color(fn ($record) => match ($record?->status) {
                        'verified' => 'success',
                        'un_verified' => 'warning',
                        'non_active' => 'danger',
                        default => 'gray',
                    }),

                // 4. Input Data Bisnis Biasa
                TextInput::make('slug')
                    ->readOnly()
                    ->required(),
                
                TextInput::make('email')
                    ->email()
                    ->required(),

                Textarea::make('deskripsi')
                    ->rows(3)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->weight('bold'),
                ImageColumn::make('gambar')->square(),
                
                // Di Tabel, Owner cuma bisa LIHAT status (Badge), gak bisa ubah
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'verified' => 'success',
                        'un_verified' => 'warning',
                        'non_active' => 'danger',
                        default => 'gray',
                    })
                    ->label('Status Verifikasi'),
            ])
            ->actions([
                EditAction::make()
                    ->color('warning')
                    ->label('Edit')
                    ->icon('heroicon-o-pencil'),
                
                DeleteAction::make()
                    ->color('danger')
                    ->label('Hapus')
                    ->icon('heroicon-o-trash'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => PagesListBisnis::route('/'),
            'create' => PagesCreateBisnis::route('/create'),
            'edit' => PagesEditBisnis::route('/{record}/edit'),
        ];
    }
}