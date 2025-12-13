<?php

namespace App\Filament\Owner\Resources\Pemesanans\Pages;

use App\Filament\Owner\Resources\Pemesanans\PemesananResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPemesanans extends ListRecords
{
    protected static string $resource = PemesananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
