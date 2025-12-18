<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{

    use HasUuids;

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

    public function bisnis()
    {
        return $this->belongsTo(Bisnis::class, 'bisnis_id', 'bisnis_id');
    }

    public function ulasan()
    {
        return $this->hasMany(UlasanKatalog::class, 'katalog_id', 'katalog_id');
    }

}
