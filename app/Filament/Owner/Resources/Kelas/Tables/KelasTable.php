<?php

namespace App\Filament\Owner\Resources\Kelas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class KelasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('katalog.nama')
                    ->label('Nama Kelas')
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
                TextColumn::make('jumlah')
                    ->label('Jumlah Anggota')
                    ->searchable(),
                TextColumn::make('tgl_mulai_booking')
                    ->label('Tanggal Mulai Booking')
                    ->date(),
                TextColumn::make('tgl_selesai_booking')
                    ->label('Tanggal Selesai Booking')
                    ->date(),
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
