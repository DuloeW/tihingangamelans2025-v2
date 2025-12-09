<?php

namespace App\Filament\Owner\Resources\Katalogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class KatalogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('jenis')
                    ->badge(),
                TextColumn::make('harga')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('gambar')
                    ->label('Gambar Produk')
                    ->square()
                    ->height(50)
                    ->width(50)
                    ->placeholder('No Image'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
