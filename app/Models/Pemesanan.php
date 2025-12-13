<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasUuids;
    
    protected $table = 'pemesanan';
    protected $primaryKey = 'pemesanan_id';
    public $timestamps = false;

    protected $fillable = [
        'jadwal_id',
        'katalog_id',
        'pengguna_id', 
        'tgl_mulai_booking',
        'tgl_selesai_booking',
        'status',
        'nama_grup',
        'jumlah',
        'tanggal_pemesanan',
        'total_harga',
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'jadwal_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id', 'pengguna_id');
    }

    public function katalog()
    {
        return $this->belongsTo(Katalog::class, 'katalog_id', 'katalog_id');
    }
}
