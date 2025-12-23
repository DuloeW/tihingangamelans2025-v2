<?php

namespace App\Filament\Owner\Resources\Gamelans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GamelanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_gamelan')
                    ->label('Nama Gamelan')
                    ->formatStateUsing(fn ($record) => $record?->katalog?->nama)
                    ->disabled()
                    ->dehydrated(false),
                
                TextInput::make('nama_pemesan')
                    ->label('Nama Pemesan')
                    ->formatStateUsing(fn ($record) => $record?->pengguna?->nama)
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('no_telepon_pemesan')
                    ->label('No. Telepon Pemesan')
                    ->formatStateUsing(fn ($record) => $record?->pengguna?->no_telephone)
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('email_pemesan')
                    ->label('Email Pemesan')
                    ->formatStateUsing(fn ($record) => $record?->pengguna?->email)
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('tanggal_pemesanan')
                    ->label('Tanggal Pemesanan')
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('total_harga')
                    ->label('Total Harga')
                    ->prefix('Rp')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(),

                TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set, $record) {
                        if ($record && $record->katalog) {
                            $set('total_harga', (int)$state * $record->katalog->harga);
                        }
                    }),

                Select::make('status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'paid' => 'Paid',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'failed' => 'Failed',
                    ])
                    ->default('unpaid')
                    ->required(),
            ]);
    }
}
