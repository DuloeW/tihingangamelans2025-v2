<?php

namespace App\Filament\Resources\Bisnis\Pages;

use App\Filament\Resources\Bisnis\BisnisResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditBisnis extends EditRecord
{
    protected static string $resource = BisnisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['admin_id'] = auth('admin')->id();
        return $data;
    }
}
