<?php

namespace App\Filament\Owner\Resources\Bisnis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BisnisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bisnis_id')
                    ->searchable(),
                TextColumn::make('admin_id')
                    ->searchable(),
                TextColumn::make('owner.owner_id')
                    ->searchable(),
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('gambar')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge(),
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
