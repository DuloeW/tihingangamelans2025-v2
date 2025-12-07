<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bisnis extends Model
{
    use HasUuids;
    protected $table = 'bisnis'; 
    protected $primaryKey = 'bisnis_id'; 
    public $timestamps = false; 

    protected $fillable = [
        'bisnis_id',
        'owner_id',
        'nama',
        'slug',
        'deskripsi',
        'status',
        'email',
        'gambar',
    ];

    protected $guarded = [];

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

    // /**
    //  * @return array<string, string>
    //  */
    // protected function casts(): array
    // {
    //     return [
    //         'tags' => 'array',
    //     ];
    // }
    
}