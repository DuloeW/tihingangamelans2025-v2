<?php

namespace App\Filament\Owner\Resources\Bisnis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BisnisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('owner.nama')
                    ->searchable(),
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('tags.jenis')
                    ->label('Jenis')
                    ->badge()
                    ->searchable(),
                TextColumn::make('deskripsi')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    // ['active', 'inactive', 'verified', 'unverified']
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'verified' => 'primary',
                        'inactive' => 'warning',
                        'unverified' => 'danger',
                        default => 'secondary',
                    }),
                TextColumn::make('email')
                    ->icon(Heroicon::Envelope)
                    ->iconColor('primary')
                    ->searchable(),
                TextColumn::make('contactPersons.no_telephone')
                    ->label('No. Telepon')
                    ->icon(Heroicon::Phone)
                    ->iconColor('success')
                    ->listWithLineBreaks()
                    ->searchable(),
                ImageColumn::make('gambar')
                    ->square()
                    ->size(50)
                    ->searchable(),
                TextColumn::make('dokumenBisnis.nama_dokumen')
                    ->label('Dokumen')
                    ->listWithLineBreaks()
                    ->searchable(),
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
