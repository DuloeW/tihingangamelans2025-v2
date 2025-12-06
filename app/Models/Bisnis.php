<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bisnis extends Model
{
    use HasUuids;
    protected $table = 'bisnis'; 
    protected $primaryKey = 'bisnis_id'; 
    public $incrementing = false; 
    protected $keyType = 'string';
    public $timestamps = false; 

    protected $guarded = [];

    // Relasi ke owner
    public function owner(): HasOne
    {
        return $this->hasOne(Owner::class, 'bisnis_id', 'bisnis_id');
    }

    // Relasi ke Admin
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id_admin');
    }
}