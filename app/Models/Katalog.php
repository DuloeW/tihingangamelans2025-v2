<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Katalog extends Model
{

    use HasUuids, HasFactory;

    protected $table = 'katalogs';
    protected $primaryKey = 'katalog_id';
    public $timestamps = false;
    protected $fillable = [
        'bisnis_id',
        'nama',
        'deskripsi',
        'harga',
        'jenis',
        'gambar',
    ];

    public function bisnis(): BelongsTo
    {
        return $this->belongsTo(Bisnis::class, 'bisnis_id', 'bisnis_id');
    }

    public function ulasan(): HasMany
    {
        return $this->hasMany(UlasanKatalog::class, 'katalog_id', 'katalog_id');
    }

    public function getAverageRatingAttribute(): float
    {
        return round($this->ulasan()->avg('rating') ?? 0, 1);
    }

    public function getTotalUlasanAttribute(): int
    {
        return $this->ulasan()->count();
    }

}
