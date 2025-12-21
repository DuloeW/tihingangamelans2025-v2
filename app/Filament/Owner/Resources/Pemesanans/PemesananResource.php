<?php

namespace App\Filament\Owner\Resources\Pemesanans;

use App\Filament\Owner\Resources\Pemesanans\Pages\CreatePemesanan;
use App\Filament\Owner\Resources\Pemesanans\Pages\EditPemesanan;
use App\Filament\Owner\Resources\Pemesanans\Pages\ListPemesanans;
use App\Filament\Owner\Resources\Pemesanans\Schemas\PemesananForm;
use App\Filament\Owner\Resources\Pemesanans\Tables\PemesanansTable;
use App\Models\Bisnis;
use App\Models\Pemesanan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PemesananResource extends Resource
{
    protected static ?string $model = Pemesanan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Pemesanan';

    public static function form(Schema $schema): Schema
    {
        return PemesananForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PemesanansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPemesanans::route('/'),
            'create' => CreatePemesanan::route('/create'),
            'edit' => EditPemesanan::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return Bisnis::query()
            ->where('owner_id', auth('owner')->id())
            ->whereIn('status', ['active', 'verified'])
            ->with('katalogs')
            ->whereHas('katalogs')
            ->exists();
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('katalog.bisnis', function ($query) {
                $query->where('owner_id', auth('owner')->id());
            });
    }
}
