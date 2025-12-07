<?php 

namespace App\Filament\Owner\Pages\Auth;

use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class Register extends BaseRegister 
{

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                // Kolom NAMA (Wajib disesuaikan karena defaultnya 'name')
                TextInput::make('nama')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                // Kolom USER_NAME
                TextInput::make('user_name')
                    ->label('Nama Pengguna')
                    ->required()
                    ->maxLength(255),

                // Kolom NO TELEPHONE (Tambahan)
                TextInput::make('no_telephone')
                    ->label('Nomor WhatsApp / Telepon')
                    ->tel() // Menampilkan keyboard angka di HP
                    ->required()
                    ->maxLength(20),

                // Kolom EMAIL (Standar)
                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique($this->getUserModel()), // Cek unik di tabel owner

                // Kolom PASSWORD (Standar)
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->same('passwordConfirmation'),
                
                TextInput::make('passwordConfirmation')
                    ->label('Ulangi Password')
                    ->password()
                    ->required()
                    ->dehydrated(false), // Jangan simpan kolom ini ke DB
            ]);
    }

    // 2. Override proses penyimpanan data
    protected function handleRegistration(array $data): Model
    {
        // Kita petakan input form ke kolom database secara manual
        return $this->getUserModel()::create([
            'nama' => $data['nama'], // Mapping 'nama' dari form ke DB
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'no_telephone' => $data['no_telephone'],
            'password' => Hash::make($data['password']), // Hash password manual
        ]);
    }
}