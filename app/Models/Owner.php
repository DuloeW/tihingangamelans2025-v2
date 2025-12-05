<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Owner extends Authenticatable
{
    //
    use Notifiable;

    protected $table = 'owner';
    protected $primaryKey = 'owner_id';
    public $incrementing = false;
    protected $guard = 'owner';
    protected $keyType = 'string';

    // Relasi ke binis
    public function bisnis(): BelongsTo {
        return $this->belongsTo(Bisnis::class, 'bisnis_id', 'bisnis_id');
    }


}
