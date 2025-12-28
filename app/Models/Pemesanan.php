<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'nama_grup',
        'jumlah',

        'province_code',
        'city_code',
        'district_code',
        'alamat_lengkap',
        'penerima',

        'tanggal_pemesanan',
        'status',
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

    public function ulasan(): HasOne
    {
        return $this->hasOne(UlasanKatalog::class, 'pemesanan_id', 'pemesanan_id');
    }

    public function getStatusColorAttribute()
    {
        return match(strtolower($this->status)) {
            'paid', 'lunas', 'completed', 'selesai' => 'bg-green-100 text-green-800 border border-green-200',
            'processing' => 'bg-blue-100 text-blue-800 border border-blue-200',
            'shipped' => 'bg-purple-100 text-purple-800 border border-purple-200',
            'unpaid', 'pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
            'cancelled', 'batal', 'failed' => 'bg-red-100 text-red-800 border border-red-200',
            default => 'bg-gray-100 text-gray-800 border border-gray-200'
        };
    }

    public function getStatusLabelAttribute()
    {
        return match(strtolower($this->status)) {
            'unpaid' => 'Belum Bayar',
            'paid' => 'Lunas',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            default => ucfirst($this->status)
        };
    }
}
