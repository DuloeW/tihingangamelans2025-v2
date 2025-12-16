<?php

namespace App\Filament\Resources\Gamelans\Pages;

use App\Filament\Resources\Gamelans\GamelanResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateGamelan extends CreateRecord
{
    protected static string $resource = GamelanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['admin_id'] = auth('admin')->user()->admin_id;
        $data['slug'] = Str::slug($data['nama']);
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
