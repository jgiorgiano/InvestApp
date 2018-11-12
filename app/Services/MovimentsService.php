<?php

namespace App\Services;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MovimentCreateRequest;
use App\Http\Requests\MovimentUpdateRequest;
use App\Repositories\MovimentRepository;
use App\Validators\MovimentValidator;
use App\Entities\Group;
use App\Entities\Products;
use App\Entities\Moviment;
use Auth;


class MovimentsService{

private $repository;
private $validator;

public function __construct(MovimentRepository $repository, MovimentValidator $validator, Products $product)
{
    $this->repository = $repository;
    $this->validator = $validator;
    $this->product = $product;

}

public function StoreInvest($data, $user_id, $productList){

    try{

    $data['user_id'] = $user_id;
    $data['type']    = 1;    

    $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

    $request = $this->repository->create($data);

    return [
        'success'   => true,
        'message'   => 'Aplicacão de R$ ' . number_format($data['value'],2 , ",", ".") . ' efetuada com sucesso no produto ' . $productList[$data['product_id']] . '.',
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

public function getBackStore($data, $user_id, $productList){

    try{

    $data['user_id'] = $user_id;
    $data['type']    = 2;    

    $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
    
    
 //refazer essa parte utilizando  eloquente, ja tenho o method getTotal no Products Entities, mas nao consegui fazer funcionar

        $inFlows = Moviment::where(['user_id' => Auth::user()->id, 'product_id' => $data['product_id'], 'group_id' => $data['group_id'], 'type' => 1])->sum('value');
        $outFlows = Moviment::where(['user_id' => Auth::user()->id, 'product_id' => $data['product_id'], 'group_id' => $data['group_id'], 'type' => 2])->sum('value');
        $totalAvailable = $inFlows - $outFlows;   
    
    if($data['value'] <= $totalAvailable){

        $request = $this->repository->create($data);   

        return [
            'success'   => true,
            'message'   => 'Resgate de R$ ' . number_format($data['value'],2 , ",", ".") . ' efetuado com sucesso no produto ' . $productList[$data['product_id']] . '.',
            'data'      => $request,
        ];
        
    }else{

        return [
            'success'   => false,
            'message'   => 'Resgate não autorizado, valor disponivel para resgate R$ ' . number_format($totalAvailable,2 , ",", ".") . '  no produto ' . $productList[$data['product_id']] . '.',
            'data'      => null,
        ];
    };    
    
    }
    catch(\Exception $e){
       
        switch (get_class($e)) {
            case QueryException::Class      : return ['success' => false, 'message' => $e->getMessage() . 'Houve um erro no processo de Resgate'];                 
                break;
            case ValidatorException::Class  : return ['success' => false, 'message' => $e->getMessageBag() . 'Houve um erro no processo de Resgate'];                 
                break;
            case Exception::Class           : return ['success' => false, 'message' => $e->getMessage() . 'Houve um erro no processo de Resgate'];                 
                break;                
            default                         : return ['success' => false, 'message' => $e->getMessage() . 'Houve um erro no processo de Resgate'];
                break;
        }
    }    

}



}