<?php

namespace App\Filament\Owner\Resources\Pemesanans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PemesananForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('pengguna_id')
                    ->required(),
                TextInput::make('katalog_id')
                    ->required(),
                TextInput::make('jadwal_id'),
                DatePicker::make('tgl_mulai_booking'),
                DatePicker::make('tgl_selesai_booking'),
                DateTimePicker::make('tanggal_pemesanan')
                    ->required(),
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
                TextInput::make('total_harga')
                    ->required()
                    ->numeric(),
            ]);
    }
}
