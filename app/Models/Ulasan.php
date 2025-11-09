<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ulasan extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'ulasan';
    protected $primaryKey = 'ulasan_id';
    public $timestamps = false;
}
