<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

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


}
