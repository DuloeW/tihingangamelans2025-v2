<?php

namespace App\Filament\Resources\Bisnis\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
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
                Section::make('Verifikasi Bisnis')
                ->description('Bagian ini khusus untuk Admin melakukan verifikasi.')
                ->schema([
                    Select::make('status')
                        ->label('Status Verifikasi')
                        ->options([
                            'unverified' => 'Unverified',
                            'verified' => 'Verified',
                            'active' => 'Active',
                            'inactive' => 'Inactive',
                        ])
                        ->required()
                        ->native(false), // Tampilan lebih bagus
                ]),

                Section::make('Informasi Utama')
                ->schema([
                    TextInput::make('nama')
                        ->label('Nama Bisnis')
                        ->disabled(),

                    TextInput::make('email')
                        ->label('Email Bisnis')
                        ->email()
                        ->disabled(),

                    FileUpload::make('gambar')
                        ->disk('public')
                        ->label('Logo Bisnis')
                        ->image()
                        ->disabled()
                        ->dehydrated(false),

                    Textarea::make('deskripsi')
                        ->label('Deskripsi Bisnis')
                        ->rows(4)
                        ->disabled(),
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
                    ->disabled() // Kunci total
                    ->addable(false)
                    ->deletable(false),
                ]),

                // --- BAGIAN 3: RELASI DOKUMEN (HAS MANY) ---
                Section::make('Dokumen Legalitas')
                    ->schema([
                        // Gunakan nama fungsi relasi di Model Bisnis: 'dokumenBisnis'
                        Repeater::make('dokumenBisnis')
                            ->relationship('dokumenBisnis')
                            ->schema([
                                TextInput::make('nama_dokumen')
                                    ->label('Nama Dokumen')
                                    ->required()
                                    ->maxLength(255)
                                    ->disabled(),

                                FileUpload::make('path')
                                    ->label('File Dokumen')
                                    ->disk('public')
                                    ->openable(true)     
                                    ->downloadable(true) 
                                    ->dehydrated(false)  
                                    ->previewable(true),
                            ])
                            ->label('Dokumen Legalitas')
                            ->addable(false)
                            ->deletable(false)
                            ->reorderable(false)
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
                                ->disabled()
                                ->addable(false)
                                ->deletable(false)
                                ->reorderable(false)
                        ]),
            ]);
    }
}
