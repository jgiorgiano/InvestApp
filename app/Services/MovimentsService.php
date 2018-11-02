<?php

namespace App\Services;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MovimentCreateRequest;
use App\Http\Requests\MovimentUpdateRequest;
use App\Repositories\MovimentRepository;
use App\Validators\MovimentValidator;


class MovimentsService{

private $repository;
private $validator;

public function __construct(MovimentRepository $repository, MovimentValidator $validator)
{
    $this->repository = $repository;
    $this->validator = $validator;

}

public function StoreInvest($data, $user_id){

    try{

    $data['user_id'] = $user_id;
    $data['type']    = 1;    

    $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

    $request = $this->repository->create($data);

    return [
        'success'   => true,
        'message'   => 'Aplicacão de R$ ' . $data['value'] . ' efetuada com sucesso no produto ' . $data['product_id'] . '.',
        'data'      => $request,
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