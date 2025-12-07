<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Admin extends Authenticatable implements FilamentUser, HasName
{
    use HasUuids;
    
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    protected $guard = 'admin';
    public $timestamps = false;

    protected $fillable = [
        'nama', 
        'email', 
        'password',
        'user_name',    
        'no_telephone'
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        // Return true agar semua data di tabel admin bisa login ke panel
        return true; 
    }
    
    public function getFilamentName(): string
    {
        // Beritahu Filament bahwa nama user ada di kolom 'nama'
        return $this->nama;
    }
}
