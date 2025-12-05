<?php

namespace App\Filament\Resources\Gamelans;
use App\Models\Gamelan;
use BackedEnum;

use App\Filament\Resources\Gamelans\Pages\CreateGamelan;
use App\Filament\Resources\Gamelans\Pages\EditGamelan;
use App\Filament\Resources\Gamelans\Pages\ListGamelans;
use App\Filament\Resources\Gamelans\Schemas\GamelanForm;
use App\Filament\Resources\Gamelans\Tables\GamelansTable;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;


use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;

use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Illuminate\Support\HtmlString;
use Illuminate\Support\facades\Storage;

class GamelanResource extends Resource
{
    protected static ?string $model = Gamelan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Gallery';
    protected static ?string $modelLabel = 'Gamelan';

    protected static ?string $recordTitleAttribute = 'Gamelans';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([ 
                
               
                Hidden::make('admin_id')
                    ->default(fn () => auth()->id())
                    ->required(),

               
                TextInput::make('nama')
                    ->required()
                    ->maxLength(100)
                    ->label('Nama Gamelan'),

               
                FileUpload::make('gambar')
                    ->directory('gamelan-images')
                    ->image()
                    ->required()
                    ->columnSpanFull(),

             
                FileUpload::make('audio')
                    ->label('File Audio Gamelan')
                    ->directory('gamelan-audio')
                    ->acceptedFileTypes(['audio/*', 'application/octet-stream'])
                    ->maxSize(10240)
                    ->required()
                    ->columnSpanFull(),

               
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
                TextColumn::make('nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->label('Nama'),

                ImageColumn::make('gambar')
                    ->square()
                    ->size(60)
                    ->label('Gambar'),

                TextColumn::make('deskripsi')
                    ->limit(50)
                    ->wrap()
                    ->sortable()
                    ->color('gray'),


                TextColumn::make('Audio')
                    ->label('File Audio')
                    ->formatStateUsing(function (Gamelan $record) {
                        if ($record->audio) {
                            $url = Storage::url($record->audio);
                            return new HtmlString("<audio controls>
                                <source src='{$url}' type='audio/*'>
                                Your browser does not support the audio element.
                            </audio>");
                        }
                        return 'No audio file';
                    })
                    ->html(true),
            ])
            ->filters([
                //
            ])

            ->actions([
               EditAction::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-o-pencil')
                    ->url(fn (Gamelan $record) => GamelanResource::getUrl('edit', ['record' => $record]))
                    ->openUrlInNewTab(false),
                DeleteAction::make('Delete')
                    ->label('Hapus')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation(),
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

    public static function getPages(): array
    {
        return [
            'index' => ListGamelans::route('/'),
            'create' => CreateGamelan::route('/create'),
            'edit' => EditGamelan::route('/{record}/edit'),
        ];
    }
}
