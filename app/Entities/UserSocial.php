<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDelete;

class UserSocial extends Model
{
    use Notifiable;
    use SoftDelete;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'social_network', 'social_id', 'social_email','Social_avatar',
    ];

    
}
   