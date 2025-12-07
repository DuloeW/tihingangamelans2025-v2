<?php

namespace App\Filament\Owner\Resources\Bisnis\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BisnisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('admin_id')
                    ->required(),
                Select::make('owner_id')
                    ->relationship('owner', 'owner_id'),
                TextInput::make('nama')
                    ->required(),
                TextInput::make('slug'),
                Textarea::make('deskripsi')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('gambar')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                Select::make('status')
                    ->options([
            'active' => 'Active',
            'inactive' => 'Inactive',
            'verified' => 'Verified',
            'unverified' => 'Unverified',
        ])
                    ->default('inactive')
                    ->required(),
            ]);
    }
}
