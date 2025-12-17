<?php

namespace App\Filament\Owner\Resources\Jadwals\Pages;

use App\Filament\Owner\Resources\Jadwals\JadwalResource;
use App\Models\Jadwal;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateJadwal extends CreateRecord
{
    protected static string $resource = JadwalResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $existingJadwal = Jadwal::where('waktu_mulai', $data['waktu_mulai'])
            ->exists();
        
        if ($existingJadwal) {
            Notification::make()
                ->title('Gagal Membuat Jadwal')
                ->body('Waktu mulai yang Anda pilih sudah terdaftar. Silakan pilih waktu yang berbeda.')
                ->danger()
                ->send();
            
            $this->halt();
        }
        
        return $data;
    }
}
