<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BisnisResource\Pages;
use App\Models\Bisnis;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Resources\BisnisResource\Tables\BisnisTable;
use App\Filament\Resources\BisnisResource\Schemas\BisnisForm;
use App\Filament\Resources\BisnisResource\Pages\CreateBisnis;
use App\Filament\Resources\BisnisResource\Pages\EditBisnis;
use App\Filament\Resources\BisnisResource\Pages\ListBisnis;



// IMPORT V4 SCHEMA
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select; 
use Filament\Forms\Set; 


// IMPORT HELPERS
use Illuminate\Support\Str; 
use Filament\Support\Icons\Heroicon;

// IMPORT COLUMNS
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

//IMPORT ACTIONS
use Filament\Actions\Action;
use Filament\Actions\BulkAction;

class BisnisResource extends Resource
{
    protected static ?string $model = Bisnis::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-storefront'; 

    protected static ?string $navigationLabel = 'Bisnis Gamelan';
    protected static ?string $modelLabel = 'Bisnis';

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
              
                Hidden::make('admin_id')
                    ->default(fn () => auth()->id())
                    ->required(),

                TextInput::make('Nama Bisnis')
                    ->required()
                    ->maxLength(100)
                    ->label('Nama Bisnis'),

                
                TextInput::make('Nama Owner')
                    ->required()
                    ->maxLength(100)
                    ->label('Nama Owner'),

              
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

               
                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'non_active' => 'Non Active',
                        'verified' => 'Verified',
                        'un_verified' => 'Unverified',
                    ])
                    ->required()
                    ->default('un_verified'),
               
                Textarea::make('deskripsi')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom Nama
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->label('Nama Bisnis'),

                TextColumn::make('nama_owner')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Owner'),

                // Kolom Gambar
                ImageColumn::make('gambar')
                    ->square()
                    ->size(60)
                    ->label('Gambar'),

                // Kolom Email
                TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->color('gray'),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'verified' => 'success',   
                        'active' => 'info',         
                        'un_verified' => 'warning', 
                        'non_active' => 'danger',   
                        default => 'gray',
                    }),

                
                TextColumn::make('deskripsi')
                    ->limit(40)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true), 
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('Edit')
                    ->label('Edit')
                    ->icon('heroicon-m-pencil-square')
                    ->color('warning'), 

                
                Action::make('Delete')
                    ->label('Hapus')
                    ->icon('heroicon-m-trash')
                    ->color('warning'),

                 BulkAction::make('bulkDelete')
                    ->label('Hapus Terpilih')
                    ->requiresConfirmation(),

                BulkAction::make('bulkEdit')
                    ->label('Edit Terpilih')
                    ->requiresConfirmation(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

   public static function getPages(): array {
        return [
            'index' => ListBisnis::route('/'),
            'create' => CreateBisnis::route('/create'),
            'edit' => EditBisnis::route('/{record}/edit'),  
        ];
    }
}