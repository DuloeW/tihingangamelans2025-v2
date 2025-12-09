<?php

namespace App\Filament\Owner\Resources\Katalogs\Schemas;

use Filament\Forms\Components\FileUpload;
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
                FileUpload::make('gambar')
                    ->disk('public')
                    ->image()
                    ->maxSize(2048)
                    ->directory('katalog-gambars')
                    ->required(),
            ]);
    }
}
