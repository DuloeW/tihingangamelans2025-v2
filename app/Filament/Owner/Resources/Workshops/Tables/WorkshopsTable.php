<?php

namespace App\Filament\Owner\Resources\Workshops\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class WorkshopsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('katalog.nama')
                    ->label('Nama Workshop')
                    ->searchable(),
                TextColumn::make('pengguna.nama')
                    ->label('Nama Pemesan')
                    ->searchable(),
                TextColumn::make('pengguna.no_telephone')
                    ->label('No. Telepon Pemesan')
                    ->searchable(),
                TextColumn::make('pengguna.email')
                    ->label('Email Pemesan')
                    ->searchable(),
                TextColumn::make('jadwal.waktu_mulai')
                    ->label('Tanggal Mulai Workshop')
                    ->dateTime(),
                TextColumn::make('jadwal.waktu_selesai')
                    ->label('Tanggal Selesai Workshop')
                    ->dateTime(),
                TextColumn::make('tanggal_pemesanan')
                    ->label('Tanggal Pemesanan')
                    ->date(),
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
                TextColumn::make('jumlah')
                    ->label('Jumlah'),
                TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->money('idr', true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'paid' => 'Paid',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'failed' => 'Failed',
                    ])
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
