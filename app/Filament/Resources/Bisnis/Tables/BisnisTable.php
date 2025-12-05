<?php

namespace App\Filament\Resources\Bisnis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BisnisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Bisnis')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('nama_owner')
                    ->label('Nama Owner')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('status')
                    ->label('Status')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),


            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                    // ...
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
