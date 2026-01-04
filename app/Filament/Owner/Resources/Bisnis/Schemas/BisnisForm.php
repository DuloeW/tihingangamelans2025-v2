<?php

namespace App\Filament\Owner\Resources\Bisnis\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BisnisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Informasi Utama')
                ->schema([
                    TextInput::make('nama')
                        ->label('Nama Bisnis')
                        ->required()
                        ->maxLength(255)
                        ->required(),

                    TextInput::make('email')
                        ->label('Email Bisnis')
                        ->email()
                        ->required()
                        ->maxLength(255)
                        ->required(),

                    FileUpload::make('gambar')
                        ->disk('public')
                        ->label('Logo Bisnis')
                        ->image()
                        ->maxSize(2048) 
                        ->directory('bisnis-gambars') // Simpan di folder bisnis-gambars
                        ->required(),

                    Textarea::make('deskripsi')
                        ->label('Deskripsi Bisnis')
                        ->rows(4)
                        ->maxLength(1000)
                        ->required(),
                ])->columns(2),
 
                Section::make('Contact Persons')
                ->schema([
                    Repeater::make('contact_person')
                    ->relationship('contactPersons')
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama Contact Person')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('no_telephone')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                    ])
                ]),

               
                // --- BAGIAN 3: RELASI DOKUMEN (HAS MANY) ---
                Section::make('Dokumen Legalitas')
                    ->schema([
                        Repeater::make('dokumenBisnis')
                            ->relationship('dokumenBisnis')
                            ->schema([
                                TextInput::make('nama_dokumen')
                                    ->label('Nama Dokumen')
                                    ->required()
                                    ->maxLength(255),

                                FileUpload::make('path')
                                    ->label('File Dokumen')
                                    ->disk('public')
                                    ->directory('dokumen-bisnis')
                                    ->openable(true)
                                    ->previewable(true)
                                    ->required(),
                            ])
                            ->label('Dokumen Legalitas')
                            ->columns(2),   
                    ]),

                    // --- BAGIAN 4: TAG BISNIS (HAS MANY) ---
                    Section::make('Kategori Bisnis')
                        ->schema([
                            Repeater::make('tags')
                            ->relationship('tags') // Ini aman karena Repeater support HasMany
                            ->schema([
                                Select::make('jenis')
                                    ->label('Pilih Kategori')
                                    ->options([
                                        'Learn' => 'Learn',
                                        'Workshop' => 'Workshop',
                                        'Purchase' => 'Purchase',
                                    ])
                                    ->required()
                                    // Opsional: Agar tidak bisa pilih kategori yang sama 2x
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems(),
                                ])
                                ->grid(3) // Agar tampil berjejer ke samping (rapi)
                                ->addActionLabel('Tambah Kategori')
                                ->defaultItems(1),
                        ]),
            ]);
    }
}
