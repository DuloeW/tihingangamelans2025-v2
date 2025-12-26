<?php

namespace App\Filament\Owner\Resources\Gamelans\Pages;

use App\Filament\Owner\Resources\Gamelans\GamelanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGamelans extends ListRecords
{
    protected static string $resource = GamelanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
