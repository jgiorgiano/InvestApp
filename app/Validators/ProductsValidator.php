<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class ProductsValidator.
 *
 * @package namespace App\Validators;
 */
class ProductsValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        'institution_id'    => 'required', 
        'name'              => 'required', 
        'description'       => 'required', 
        'interest_rate'     => 'required', 
        'index'             => 'required', 
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
