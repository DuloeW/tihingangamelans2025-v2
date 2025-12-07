<?php

namespace App\Filament\Resources\Bisnis\Pages;

use App\Filament\Owner\Resources\Bisnis\BisnisResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBisnis extends EditRecord
{
    protected static string $resource = BisnisResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }

    public function getTitle(): string 
    {
        return 'Profil Bisnis';
    }
}
