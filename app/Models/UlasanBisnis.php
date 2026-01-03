<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UlasanBisnis extends Model
{
    use HasUuids, HasFactory;

    protected $table = 'ulasan_bisnis';
    protected $primaryKey = 'ulasan_bisnis_id';
    public $timestamps = true;
    protected $fillable = [
        'pengguna_id',
        'bisnis_id',
        'isi_ulasan',
        'rating',
        'nama_pengulas'
    ];

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function bisnis(): BelongsTo
    {
        return $this->belongsTo(Bisnis::class, 'bisnis_id');
    }
    
}
