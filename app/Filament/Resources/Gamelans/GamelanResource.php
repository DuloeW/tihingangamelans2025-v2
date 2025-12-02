<?php

namespace App\Filament\Resources\Gamelans;

use App\Filament\Resources\Gamelans\Pages\CreateGamelan;
use App\Filament\Resources\Gamelans\Pages\EditGamelan;
use App\Filament\Resources\Gamelans\Pages\ListGamelans;
use App\Filament\Resources\Gamelans\Schemas\GamelanForm;
use App\Filament\Resources\Gamelans\Tables\GamelansTable;
use App\Models\Gamelan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GamelanResource extends Resource
{
    protected static ?string $model = Gamelan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

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

    public static function getPages(): array
    {
        return [
            'index' => ListGamelans::route('/'),
            'create' => CreateGamelan::route('/create'),
            'edit' => EditGamelan::route('/{record}/edit'),
        ];
    }
}
