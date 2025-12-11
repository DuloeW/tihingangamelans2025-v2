<?php

namespace App\Filament\Owner\Resources\Jadwals\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class JadwalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('jadwal_id')
                //     ->searchable(),
                TextColumn::make('katalog.nama')
                    ->searchable(),
                TextColumn::make('waktu_mulai')
                    ->dateTime()
                    ->badge()
                    ->color('primary')
                    ->sortable(),
                TextColumn::make('waktu_selesai')
                    ->dateTime()
                    ->badge()
                    ->color('danger')
                    ->sortable(),
                TextColumn::make('kuota')
                    ->numeric()
                    ->sortable(),
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
