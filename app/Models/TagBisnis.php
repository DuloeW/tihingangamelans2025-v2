<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class TagBisnis extends Model
{
    use HasUuids;

    protected $table = 'tag_bisnis';
    protected $primaryKey = 'tag_bisnis_id';
    public $timestamps = false;

    protected $fillable = [
        'tag_bisnis_id',
        'bisnis_id',
        'jenis',
    ];
}
