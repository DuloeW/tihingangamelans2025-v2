<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasanKatalog extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'ulasan_katalog';
    protected $primaryKey = 'ulasan_katalog_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'katalog_id',
        'pengguna_id',
        'rating',
        'komentar',
        'nama_pengulas',
    ];

    // Relasi balik ke Katalog
    public function katalog()
    {
        return $this->belongsTo(Katalog::class, 'katalog_id');
    }

    // Relasi balik ke Pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}