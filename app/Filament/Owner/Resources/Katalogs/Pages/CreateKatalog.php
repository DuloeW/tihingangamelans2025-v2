<?php

namespace App\Filament\Owner\Resources\Katalogs\Pages;

use App\Filament\Owner\Resources\Katalogs\KatalogResource;
use App\Models\Bisnis;
use Filament\Resources\Pages\CreateRecord;

class CreateKatalog extends CreateRecord
{
    protected static string $resource = KatalogResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $owner_id = auth('owner')->user()->owner_id;
        $bisnis_id = Bisnis::where('owner_id', $owner_id)->first()->bisnis_id;
        $data['bisnis_id'] = $bisnis_id;
        return $data;
    }
}
