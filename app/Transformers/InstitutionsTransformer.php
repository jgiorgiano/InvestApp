<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Institutions;

/**
 * Class InstitutionsTransformer.
 *
 * @package namespace App\Transformers;
 */
class InstitutionsTransformer extends TransformerAbstract
{
    /**
     * Transform the Institutions entity.
     *
     * @param \App\Entities\Institutions $model
     *
     * @return array
     */
    public function transform(Institutions $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
