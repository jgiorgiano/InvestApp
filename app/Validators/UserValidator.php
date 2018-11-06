<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class UserValidator.
 *
 * @package namespace App\Validators;
 */
class UserValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'  => 'required',
            'cpf'   => 'required|digits:11',
            'phone' => 'required|digits:11',
            'email' => 'required|email',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'  => 'required',
            'cpf'   => 'required|digits:11',
            'phone' => 'required|digits:11',
            'email' => 'required|email',
            'oldPassword' => 'required',
        ]
    ];
}
