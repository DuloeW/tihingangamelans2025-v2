<?php

namespace App\Filament\Owner\Resources\Katalogs\Schemas;

use App\Models\Bisnis;
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
                    ->options(function () {
                        $ownerId = auth('owner')->id();
                        $bisnis = Bisnis::with('tags')
                                    ->where('owner_id', $ownerId)
                                    ->first();

                        if (! $bisnis) {
                            return [];
                        }

                        return $bisnis->tags
                            ->whereNotNull('jenis')
                            ->mapWithKeys(function ($tag) {
                                $tagName = $tag->jenis; 
                                
                                $convertedName = match ($tagName) {
                                    'Learn'    => 'Kelas',     
                                    'Purchase' => 'Gamelan',   
                                    'Workshop' => 'Workshop',  
                                    default    => $tagName,
                                };

                                return [$convertedName => $convertedName];
                            })
                            ->toArray();
                    })
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
