<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Model
{
    use Notifiable;

    protected $table = 'admin'; 
    protected $fillable = ['nama', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
}
