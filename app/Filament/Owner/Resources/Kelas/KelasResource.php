<?php

namespace App\Filament\Owner\Resources\Kelas;

use App\Filament\Owner\Resources\Kelas\Pages\CreateKelas;
use App\Filament\Owner\Resources\Kelas\Pages\EditKelas;
use App\Filament\Owner\Resources\Kelas\Pages\ListKelas;
use App\Filament\Owner\Resources\Kelas\Schemas\KelasForm;
use App\Filament\Owner\Resources\Kelas\Tables\KelasTable;
use App\Models\Pemesanan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class KelasResource extends Resource
{
    protected static ?string $model = Pemesanan::class;

    protected static ?string $modelLabel = 'Kelas';
    protected static ?string $pluralModelLabel = 'Pesanan Kelas';
    protected static ?string $navigationLabel = 'Kelas';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AcademicCap;

    protected static string | UnitEnum | null $navigationGroup = 'Pemesanan';

    protected static ?string $recordTitleAttribute = 'Kelas';

    public static function form(Schema $schema): Schema
    {
        return KelasForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KelasTable::configure($table);
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
                $query->where('jenis', 'Kelas')
                    ->whereHas('bisnis', function ($query) {
                        $query->where('owner_id', auth('owner')->id());
                    });
            });
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKelas::route('/'),
            // 'create' => CreateKelas::route('/create'),
            'edit' => EditKelas::route('/{record}/edit'),
        ];
    }
}
