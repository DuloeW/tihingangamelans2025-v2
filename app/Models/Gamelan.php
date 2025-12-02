<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // PENTING: Untuk UUID
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gamelan extends Model
{
    use HasUuids; // Agar otomatis generate UUID

    // 1. Konfigurasi Tabel Custom
    protected $table = 'gamelan'; 
    protected $primaryKey = 'gamelan_id'; // Sesuai migration kamu
    public $incrementing = false; // Karena UUID bukan angka urut
    protected $keyType = 'string';
    public $timestamps = false; // Karena migration kamu tidak ada timestamps()

    protected $guarded = [];

    // 2. Relasi ke Admin (Opsional tapi bagus)
    public function admin(): BelongsTo
    {
        // Asumsi model Admin ada di App\Models\Admin
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }
}