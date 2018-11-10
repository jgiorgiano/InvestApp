<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDelete;

class usersGroup extends Model
{
    use SoftDelete;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 
        'user_id', 'group_id', 'permission',        
    ];
  

}
