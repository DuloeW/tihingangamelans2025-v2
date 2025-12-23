<?php

namespace App\Filament\Owner\Resources\Workshops;

use App\Filament\Owner\Resources\Workshops\Pages\CreateWorkshop;
use App\Filament\Owner\Resources\Workshops\Pages\EditWorkshop;
use App\Filament\Owner\Resources\Workshops\Pages\ListWorkshops;
use App\Filament\Owner\Resources\Workshops\Schemas\WorkshopForm;
use App\Filament\Owner\Resources\Workshops\Tables\WorkshopsTable;
use App\Models\Pemesanan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class WorkshopResource extends Resource
{
    protected static ?string $model = Pemesanan::class;

    protected static ?string $modelLabel = 'Workshop';

    protected static ?string $pluralModelLabel = 'Pesanan Workshop';

    protected static ?string $navigationLabel = 'Workshop';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Wrench;

    protected static string | UnitEnum | null $navigationGroup = 'Pemesanan';
    
    protected static ?string $recordTitleAttribute = 'Workshop';

    public static function form(Schema $schema): Schema
    {
        return WorkshopForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorkshopsTable::configure($table);
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
                $query->where('jenis', 'Workshop')
                    ->whereHas('bisnis', function ($query) {
                        $query->where('owner_id', auth('owner')->id());
                    });
            });
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWorkshops::route('/'),
            // 'create' => CreateWorkshop::route('/create'),
            'edit' => EditWorkshop::route('/{record}/edit'),
        ];
    }
}
