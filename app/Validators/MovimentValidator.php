<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class MovimentValidator.
 *
 * @package namespace App\Validators;
 */
class MovimentValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'user_id'       => 'required',
            'product_id'    => 'required',
            'group_id'      => 'required',
            'value'         => 'required',
            'type'          => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
