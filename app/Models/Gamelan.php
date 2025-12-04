<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // PENTING: Untuk UUID
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gamelan extends Model
{
    use HasUuids; 

    protected $table = 'gamelan'; 
    protected $primaryKey = 'gamelan_id'; 
    public $incrementing = false; 
    protected $keyType = 'string';
    public $timestamps = false; 

    protected $guarded = [];

  
    public function admin(): BelongsTo
    {
        
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }
}