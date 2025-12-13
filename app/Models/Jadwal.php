<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jadwal extends Model
{
    use HasUuids;

    protected $table = 'jadwal';
    protected $primaryKey = 'jadwal_id';
    public $timestamps = false;

    protected $fillable = [
        'katalog_id',
        'waktu_mulai',
        'waktu_selesai',
        'kuota',
    ];

    public function katalog()
    {
        return $this->belongsTo(Katalog::class, 'katalog_id', 'katalog_id');
    }

    public function pemesanans(): HasMany
    {
        return $this->hasMany(Pemesanan::class, 'jadwal_id', 'jadwal_id');
    }
}
