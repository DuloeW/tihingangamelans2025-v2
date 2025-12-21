<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // PENTING: Untuk UUID
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gamelan extends Model
{
    use HasUuids, HasFactory; 

    protected $table = 'gamelan'; 
    protected $primaryKey = 'gamelan_id'; 
    public $timestamps = false; 

    protected $fillable = [
        'admin_id',
        'nama',
        'slug',
        'deskripsi',
        'gambar',
        'audio'
    ];
  
    public function admin(): BelongsTo
    {
        
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }
}