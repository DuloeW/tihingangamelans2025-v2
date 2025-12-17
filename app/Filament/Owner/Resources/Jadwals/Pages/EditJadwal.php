<?php

namespace App\Filament\Owner\Resources\Jadwals\Pages;

use App\Filament\Owner\Resources\Jadwals\JadwalResource;
use App\Models\Jadwal;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditJadwal extends EditRecord
{
    protected static string $resource = JadwalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $existingJadwal = Jadwal::where('waktu_mulai', $data['waktu_mulai'])
            ->where('jadwal_id', '!=', $this->record->jadwal_id)
            ->exists();
        
        if ($existingJadwal) {
            Notification::make()
                ->title('Gagal Mengupdate Jadwal')
                ->body('Waktu mulai yang Anda pilih sudah terdaftar. Silakan pilih waktu yang berbeda.')
                ->danger()
                ->send();
            
            $this->halt();
        }
        
        return $data;
    }
}
