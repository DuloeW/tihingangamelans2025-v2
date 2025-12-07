<?php

namespace App\Filament\Owner\Resources\Bisnis\Pages;

use App\Filament\Owner\Resources\Bisnis\BisnisResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateBisnis extends CreateRecord
{
    protected static string $resource = BisnisResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['owner_id'] = Auth::id();

        $data['slug'] = Str::slug($data['nama']);

        $data['status'] = 'unverified';

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
