<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasanBisnis extends Model
{
    use HasUuids, HasFactory;

    protected $table = 'ulasan_bisnis';
    protected $primaryKey = 'ulasan_bisnis_id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'pengguna_id',
        'bisnis_id',
        'isi_ulasan',
        'rating',
        'nama_pengulas'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function bisnis()
    {
        return $this->belongsTo(Bisnis::class, 'bisnis_id');
    }
    
}
