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
use Illuminate\Database\Eloquent\Relations\HasOne;

class Owner extends Authenticatable implements FilamentUser, HasName
{
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

    public function bisnis(): HasOne 
    {
        return $this->hasOne(Bisnis::class, 'bisnis_id', 'bisnis_id');

    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true; 
    }

    public function getFilamentName(): string
    {
        return (String) $this->nama;
    }

}
