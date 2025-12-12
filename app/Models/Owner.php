<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Owner extends Authenticatable implements FilamentUser, HasName
{
    //
    use HasUuids, HasFactory;

    protected $table = 'owner';
    protected $primaryKey = 'owner_id';
    protected $guard = 'owner';
    public $timestamps = false;

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    protected $fillable = [
        'nama', 
        'email', 
        'password',
        'user_name',    
        'no_telephone'
    ];

    // Relasi ke binis
    public function bisnis(): BelongsTo {
        return $this->belongsTo(Bisnis::class, 'bisnis_id', 'bisnis_id');

    }

    public function bisnisList(): HasMany {
        return $this->hasMany(Bisnis::class, 'owner_id', 'owner_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Return true agar semua data di tabel owner bisa login ke panel
        return true; 
    }

    public function getFilamentName(): string
    {
        return (String) $this->nama;
    }


}
