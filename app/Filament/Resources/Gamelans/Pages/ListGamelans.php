<?php

namespace App\Filament\Resources\Gamelans\Pages;

use App\Filament\Resources\Gamelans\GamelanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGamelans extends ListRecords
{
    protected static string $resource = GamelanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
