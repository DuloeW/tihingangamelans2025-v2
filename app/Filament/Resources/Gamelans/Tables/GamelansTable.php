<?php

namespace App\Filament\Resources\Gamelans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GamelansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('gamelan_id')
                    ->searchable(),
                TextColumn::make('admin.admin_id')
                    ->searchable(),
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('gambar')
                    ->searchable(),
                TextColumn::make('audio')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
