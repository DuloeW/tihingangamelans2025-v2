<?php

namespace App\Filament\Resources\Bisnis\Pages;

use App\Filament\Owner\Resources\Bisnis\BisnisResource;
use App\Models\Bisnis;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBisnis extends ListRecords
{
    protected static string $resource = BisnisResource::class;

    protected function getHeaderActions(): array
    {

        $existingBisnis = Bisnis::where('owner_id', auth('owner')->user()->owner_id)->first();

        if($existingBisnis) {
            return [];
        }

        return [
            CreateAction::make()->label('Daftarkan Bisnis')
        ];
    }

    public function mount(): void {
        parent::mount();

        $bisnis = Bisnis::where('owner_id', auth('owner')->user()->owner_id)->first();

        if($bisnis) {
            $this->redirect(BisnisResource::getUrl('edit', ['record' => $bisnis]));
        }
    }
}
