<?php

namespace App\Presenters;

use App\Transformers\InstitutionsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InstitutionsPresenter.
 *
 * @package namespace App\Presenters;
 */
class InstitutionsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InstitutionsTransformer();
    }
}
