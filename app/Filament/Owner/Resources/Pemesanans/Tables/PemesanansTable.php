<?php

namespace App\Filament\Owner\Resources\Pemesanans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PemesanansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pemesanan_id')
                    ->searchable(),
                TextColumn::make('pengguna.nama')
                    ->label('Nama Pemesan')
                    ->searchable(),
                TextColumn::make('pengguna.email')
                    ->label('Email Pemesan')
                    ->searchable(),
                TextColumn::make('pengguna.no_telephone')
                    ->label('No. Tlp Pemesan')  
                    ->searchable(),
                TextColumn::make('katalog.nama')
                    ->searchable(),
                TextColumn::make('jadwal_id')
                    ->searchable(),
                TextColumn::make('tgl_mulai_booking')
                    ->date()
                    ->sortable(),
                TextColumn::make('tgl_selesai_booking')
                    ->date()
                    ->sortable(),
                TextColumn::make('tanggal_pemesanan')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
                    ->color(fn (string $state): string => match($state) {
                        'unpaid' => 'danger',
                        'paid' => 'warning',
                        'processing' => 'primary',
                        'shipped' => 'info',
                        'completed' => 'success',
                        'cancelled' => 'secondary',
                        'failed' => 'dark',
                        default => 'secondary',
                    })
                    ->badge(),
                TextColumn::make('total_harga')
                    ->numeric()
                    ->sortable(),
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
