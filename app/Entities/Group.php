<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Group.
 *
 * @package namespace App\Entities;
 */
class Group extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id', 'institution_id'];

    
    public function user() //alterar nome para owner
    {

        return $this->belongsTo(User::class);

    }

    // relationship any to any (groups and users)
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_groups'); // segundo parametro e o nome da tabela auxiliar

    }

    public function institution()
    {

        return $this->belongsTo(institution::class);
    }


}

