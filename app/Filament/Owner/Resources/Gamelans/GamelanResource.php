<?php

namespace App\Filament\Owner\Resources\Gamelans;

use App\Filament\Owner\Resources\Gamelans\Pages\CreateGamelan;
use App\Filament\Owner\Resources\Gamelans\Pages\EditGamelan;
use App\Filament\Owner\Resources\Gamelans\Pages\ListGamelans;
use App\Filament\Owner\Resources\Gamelans\Schemas\GamelanForm;
use App\Filament\Owner\Resources\Gamelans\Tables\GamelansTable;
use App\Models\Pemesanan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class GamelanResource extends Resource
{
    protected static ?string $model = Pemesanan::class;

    protected static ?string $modelLabel = 'Gamelan';
    protected static ?string $pluralModelLabel = 'Pesanan Gamelan';
    protected static ?string $navigationLabel = 'Gamelan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShoppingCart;

    protected static string | UnitEnum | null $navigationGroup = 'Pemesanan';

    protected static ?string $recordTitleAttribute = 'Gamelan';

    public static function form(Schema $schema): Schema
    {
        return GamelanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GamelansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereHas('katalog', function ($query) {
                $query->where('jenis', 'Gamelan')
                    ->whereHas('bisnis', function ($query) {
                        $query->where('owner_id', auth('owner')->id());
                    });
            });
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGamelans::route('/'),
            // 'create' => CreateGamelan::route('/create'),
            'edit' => EditGamelan::route('/{record}/edit'),
        ];
    }
}
