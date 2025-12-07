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

    protected $fillable = [
        'bisnis_id',
        'owner_id',
        'nama',
        'slug',
        'deskripsi',
        'status',
    ];

    protected $guarded = [];

    // Relasi ke owner
    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class, 'owner_id', 'owner_id');
    }
    
}