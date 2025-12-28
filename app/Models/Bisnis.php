<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bisnis extends Model
{
    use HasUuids, HasFactory;
    protected $table = 'bisnis'; 
    protected $primaryKey = 'bisnis_id'; 
    public $timestamps = false; 

    protected $fillable = [
        'bisnis_id',
        'admin_id',
        'owner_id',
        'nama',
        'slug',
        'deskripsi',
        'status',
        'email',
        'gambar',
    ];

    // Relasi ke owner
    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class, 'owner_id', 'owner_id');
    }

    public function contactPersons(): HasMany
    {
        return $this->hasMany(ContactPerson::class, 'bisnis_id', 'bisnis_id');
    }

    public function tags(): HasMany
    {
        return $this->hasMany(TagBisnis::class, 'bisnis_id', 'bisnis_id');
    }

    public function dokumenBisnis(): HasMany
    {
        return $this->hasMany(DokumenBisnis::class, 'bisnis_id', 'bisnis_id');
    }

    public function katalogs(): HasMany
    {
        return $this->hasMany(Katalog::class, 'bisnis_id', 'bisnis_id');
    }

    public function contactPerson(): HasMany
    {
        return $this->hasMany(ContactPerson::class, 'bisnis_id', 'bisnis_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }

    public function ulasanBisnis(): HasMany
    {
        return $this->hasMany(UlasanBisnis::class, 'bisnis_id', 'bisnis_id');
    }

    public function ulasanKatalog()
    {
        return $this->hasManyThrough(UlasanKatalog::class, Katalog::class, 'bisnis_id', 'katalog_id', 'bisnis_id', 'katalog_id');
    }

    public function getAverageRatingAttribute()
    {
        $totalRatingBisnis = $this->ulasanBisnis()->sum('rating');
        $countBisnis = $this->ulasanBisnis()->count();

        $totalRatingKatalog = $this->ulasanKatalog()->sum('rating');
        $countKatalog = $this->ulasanKatalog()->count();

        $totalRating = $totalRatingBisnis + $totalRatingKatalog;
        $totalCount = $countBisnis + $countKatalog;

        if ($totalCount == 0) {
            return 0;
        }

        return round($totalRating / $totalCount, 1);
    }

    public function getTotalUlasanAttribute()
    {
        return $this->ulasanBisnis()->count() + $this->ulasanKatalog()->count();
    }
    
}