<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

=======
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
>>>>>>> 711f6f3aa5436befdcf6b45144bd50f376bc6eb2

class Admin extends Authenticatable
{
<<<<<<< HEAD
    use Notifiable;

    protected $table = 'admin'; 
    protected $fillable = ['nama', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];
=======
    //
    use Notifiable;

    protected $guard = 'admin';
>>>>>>> 711f6f3aa5436befdcf6b45144bd50f376bc6eb2
}
