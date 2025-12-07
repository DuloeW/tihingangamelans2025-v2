<?php

namespace App\Filament\Owner\Resources\Katalogs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class KatalogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('katalog_id')
                    ->required(),
                TextInput::make('bisnis_id')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                Textarea::make('deskripsi')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('harga')
                    ->required()
                    ->numeric(),
                Select::make('jenis')
                    ->options(['Workshop' => 'Workshop', 'Kelas' => 'Kelas', 'Gamelan' => 'Gamelan'])
                    ->required(),
                TextInput::make('gambar')
                    ->required(),
            ]);
    }
}
