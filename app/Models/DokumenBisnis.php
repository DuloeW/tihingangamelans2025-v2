<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenBisnis extends Model
{
    use HasUuids, HasFactory;

    protected $table = 'dokumen_bisnis';
    protected $primaryKey = 'dokumen_bisnis_id';
    public $timestamps = false;

    protected $fillable = [
        'dokumen_bisnis_id',
        'bisnis_id',
        'nama_dokumen',
        'path',
        'tanggal_dibuat',
    ];

    protected static function booted()
    {
        static::creating(function($dokumen) {
            if(empty($dokumen->tanggal_dibuat)) {
                $dokumen->tanggal_dibuat = now();
            }
        });
    }

    protected function casts()
    {
        return [
            'tanggal_dibuat' => 'datetime',
        ];
    }

}
