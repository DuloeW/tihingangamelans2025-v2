<?php

namespace App\Filament\Resources\Bisnis\Pages;

use App\Filament\Resources\Bisnis\BisnisResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBisnis extends ListRecords
{
    protected static string $resource = BisnisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }
}
