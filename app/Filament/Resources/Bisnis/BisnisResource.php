<?php

namespace App\Filament\Resources\Bisnis;

use App\Filament\Resources\Bisnis\Pages\CreateBisnis;
use App\Filament\Resources\Bisnis\Pages\EditBisnis;
use App\Filament\Resources\Bisnis\Pages\ListBisnis;
use App\Filament\Resources\Bisnis\Schemas\BisnisForm;
use App\Filament\Resources\Bisnis\Tables\BisnisTable;
use App\Models\Bisnis;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BisnisResource extends Resource
{
    protected static ?string $model = Bisnis::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Bisnis';

    public static function form(Schema $schema): Schema
    {
        return BisnisForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BisnisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBisnis::route('/'),
            // 'create' => CreateBisnis::route('/create'),
            'edit' => EditBisnis::route('/{record}/edit'),
        ];
    }
}
