<?php

namespace App\Filament\Resources\Gamelans\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class GamelanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('admin_id')
                    ->relationship('admin', 'admin_id')
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                Textarea::make('deskripsi')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('gambar')
                    ->required(),
                TextInput::make('audio')
                    ->required(),
            ]);
    }
}
