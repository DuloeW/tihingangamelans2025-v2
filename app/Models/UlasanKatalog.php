<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UlasanKatalog extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'ulasan_katalog';
    protected $primaryKey = 'ulasan_katalog_id';
    public $timestamps = true;

    protected $fillable = [
        'katalog_id',
        'pengguna_id',
        'pemesanan_id',
        'rating',
        'isi_ulasan',
        'nama_pengulas',
    ];

    public function katalog(): BelongsTo
    {
        return $this->belongsTo(Katalog::class, 'katalog_id');
    }

    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function pemesanan(): BelongsTo
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id');
    }

}