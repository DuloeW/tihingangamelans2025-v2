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

class Owner extends Authenticatable implements FilamentUser, HasName
{
    //
    use Notifiable;

    protected $table = 'owner';
    protected $primaryKey = 'owner_id';
    public $incrementing = false;
    protected $guard = 'owner';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $guarded = [];

    protected $hidden = [
        'password',
    
    ];

    protected $casts = [
        'password' => 'hashed',
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
