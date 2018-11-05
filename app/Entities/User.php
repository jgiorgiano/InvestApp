<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes; // recurso inserido nas migrations

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cpf', 'name', 'phone', 'birth','gender', 'notes', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

 // relationship any to any (groups and users)
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'users_groups');
    }

    public function products()
    {
        return $this->hasMany(Products::class);
    }

    public function moviments()
    {
        return $this->hasMany(Moviment::class);
    }


 // mutator em uso para tratamento dos dados recebidos do DB para melhor UX

    public function getFormatedCpfAttribute()
    {         
        $value = $this->attributes['cpf'];       
        return substr($value, 0 , 3) . "." . substr($value, 3 , 3). "." . substr($value, 6, 3 ) . "-" . substr($value, -2);

    }
    

    public function getFormatedPhoneAttribute()
    {
        $value = $this->attributes['phone'];
        return "(" . substr($value, 0, 2) . ") " . substr($value, 2, 5) . " - " . substr($value, 7, 4);
    }


    public function getFormatedNameAttribute()
    {
        $value = $this->attributes['name'];
        return ucfirst($value);
    }

}
