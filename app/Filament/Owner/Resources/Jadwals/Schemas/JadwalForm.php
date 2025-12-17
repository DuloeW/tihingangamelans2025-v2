<?php

namespace App\Filament\Owner\Resources\Jadwals\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class JadwalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('katalog_id')
                    ->relationship('katalog', 'nama',
                        fn ($query) => $query->whereHas('bisnis', fn ($q) => 
                            $q->where('owner_id', auth('owner')->id())
                        )->where('jenis', 'Workshop')
                    )
                    ->required(),
                TextInput::make('kuota')
                    ->required()
                    ->numeric()
                    ->default(1),
                DateTimePicker::make('waktu_mulai')
                    ->native(false)
                    ->minDate(now())
                    ->required(),
                DateTimePicker::make('waktu_selesai')
                    ->native(false)
                    ->minDate(now())
                    ->required(),
            ]);
    }
}
