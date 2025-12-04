<?php

namespace App\Filament\Resources\BisnisResource\Pages;

use App\Filament\Resources\BisnisResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBisnis extends ListRecords
{
    protected static string $resource = BisnisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
