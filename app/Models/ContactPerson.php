<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    use HasUuids, HasFactory;

    protected $table = 'contact_person';
    protected $primaryKey = 'contact_person_id';
    public $timestamps = false;

    protected $fillable = [
        'contact_person_id',
        'bisnis_id',
        'nama',
        'no_telephone',
    ];
}
