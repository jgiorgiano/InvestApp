<?php

namespace App\Services;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
/* use App\Http\Requests\ProductsCreateRequest;
use App\Http\Requests\ProductsUpdateRequest; */
use App\Repositories\ProductsRepository;
use App\Validators\ProductsValidator;


class ProductService 
{
    private $repository;
    private $validator;

    public function __construct(ProductsRepository $repository, ProductsValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function store($data, $inst_id)
    {
        try{

            
        $data['institution_id'] = $inst_id; // add o campo ao array da request
        
        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
       
        $product = $this->repository->create($data);

        return [
            'success' => true,
            'message' =>'Produto Cadastrada com Sucesso',
            'data' => $product,
        ];

        }
        catch(\Exception $e){

            switch (get_class($e)) {
                case QueryException::Class      : return ['success' => false, 'message' => $e->getMessage() . 'Houve um erro no processo de Registro'];                 
                    break;
                case ValidatorException::Class  : return ['success' => false, 'message' => $e->getMessageBag() . 'Houve um erro no processo de Registro'];                 
                    break;
                case Exception::Class           : return ['success' => false, 'message' => $e->getMessage() . 'Houve um erro no processo de Registro'];                 
                    break;                
                default                         : return ['success' => false, 'message' => $e->getMessage() . 'Houve um erro no processo de Registro'];
                    break;
            }
        }
    }



}