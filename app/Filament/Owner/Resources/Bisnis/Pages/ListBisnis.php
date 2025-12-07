<?php

namespace App\Filament\Owner\Resources\Bisnis\Pages;

use App\Filament\Owner\Resources\Bisnis\BisnisResource;
use App\Models\Bisnis;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBisnis extends ListRecords
{
    protected static string $resource = BisnisResource::class;

    protected function getHeaderActions(): array
    {

        $haveBisnis = Bisnis::where('owner_id', auth('owner')->id())->exists();

        if($haveBisnis) {
            return [];
        }

        return [
            CreateAction::make()->label('Daftarkan Bisnis'),
        ];
    }
}
