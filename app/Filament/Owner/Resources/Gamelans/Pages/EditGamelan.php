<?php

namespace App\Filament\Owner\Resources\Gamelans\Pages;

use App\Filament\Owner\Resources\Gamelans\GamelanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGamelan extends EditRecord
{
    protected static string $resource = GamelanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
        ];
    }
}
