<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'lastname', 'phone', 'email', 'password', 'code', 'godfather', 'city'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    public function ciudad(){
      return $this->belongsTo(City::class, 'city');
    }

    public function padrino(){
      return $this->belongsTo(User::class, 'godfather', 'code');
    }
}