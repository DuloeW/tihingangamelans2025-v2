<?php

namespace App\Filament\Resources\Gamelans\Pages;

use App\Filament\Resources\Gamelans\GamelanResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGamelan extends CreateRecord
{
    protected static string $resource = GamelanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
