<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Bisnis\Pages\CreateBisnis;
use App\Filament\Resources\Bisnis\Pages\EditBisnis;
use App\Filament\Resources\Bisnis\Pages\ListBisnis;

use App\Models\Bisnis;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema; // V4
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select; // Admin butuh Select untuk ubah status
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn; // Untuk ubah status langsung di tabel

class BisnisResource extends Resource
{
    protected static ?string $model = Bisnis::class;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-check-badge';
    protected static ?string $navigationLabel = 'Verifikasi Bisnis';
    protected static ?string $modelLabel = 'Bisnis';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Admin bisa melihat/mengedit siapa ownernya
                Select::make('owner_id')
                    ->relationship('owner', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('nama')->required(),
               
                Select::make('status')
                    ->label('Status Verifikasi')
                    ->options([
                        'un_verified' => 'Unverified (Pending)',
                        'verified' => 'Verified (Aktif)',
                        'non_active' => 'Banned/Non-Active',
                    ])
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->searchable()->weight('bold'),
                TextColumn::make('owner.nama')->label('Pemilik')->searchable(),
                
                // ADMIN BISA UBAH STATUS LANGSUNG DI TABEL
                SelectColumn::make('status')
                    ->options([
                        'un_verified' => 'Pending',
                        'verified' => 'Verified',
                        'non_active' => 'Non-Active',
                    ])
                    ->selectablePlaceholder(false),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBisnis::route('/'),
            'create' => CreateBisnis::route('/create'),
            'edit' => EditBisnis::route('/{record}/edit'),
        ];
    }
}