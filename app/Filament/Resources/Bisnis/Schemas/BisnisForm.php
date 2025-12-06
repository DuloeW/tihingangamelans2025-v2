<?php

namespace App\Filament\Resources\Bisnis\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BisnisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required()
                    ->maxLength(100)
                    ->label('Nama Bisnis'),

                TextInput::make('nama_owner')
                    ->required()
                    ->maxLength(100)
                    ->label('Nama Owner'),

                TextInput::make('deskripsi')
                    ->required()
                    ->maxLength(255)
                    ->label('Deskripsi'),

                Select::make('status')
                        ->options([
                            'active' => 'Active',
                            'inactive' => 'Inactive',
                            'verified' => 'Verified',
                            'unverified' => 'Unverified',
                        ])
                        ->default('inactive'),

            ]);
    }
}
