<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Auth;

/**
 * Class Products.
 *
 * @package namespace App\Entities;
 */
class Products extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['institution_id', 'name', 'description', 'interest_rate', 'index'];



    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function moviments()
    {
        return $this->hasMany(Moviment::class, 'product_id'); // precisei colocar segundo parametro pq a coluna esta product_id e o model esta products.
    }

    public function valueFromUser(user $user){
       
        $inFlows = $this->moviments()->inFlows()->where('user_id', $user->id)->sum('value');
        $outFlows = $this->moviments()->outFlows()->where('user_id', $user->id)->sum('value');
        $total = $inFlows - $outFlows;

        return $total;
    }

    public function getTotal(user $user){


       $inFlows = $user->moviments()->inFlows()->sum('value');
       $outFlows = $user->moviments()->outFlows()->sum('value');

       $total = $inFlows - $outFlows;
       
       return $total;
        
    }
   


}
