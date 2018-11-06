<?php

namespace App\Services;

use App\Repositories\InstitutionsRepository;
use App\Validators\InstitutionsValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class InstitutionService
{

    private $repository;
    private $validator;

    public function __construct(InstitutionsRepository $repository, InstitutionsValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;

    }

    public function store($data){

        try{
            
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);// copiado do InstitutionsController
            
            $institution = $this->repository->create($data);

            return [
                'success' => true,
                'message' =>'Instituicao Cadastrada com Sucesso',
                'data' => $institution,
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



            /* return [                
                'success' => false,
                'message' => $e->getMessage() . 'Houve um erro no processo de Registro',
                
            ];
 */
        }


    }
    public function update($data, $id){

        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $institution = $this->repository->update($data, $id);

            return [
                'success' => true,
                'message' =>'Instituicao Atualizada com Sucesso',
                'data' => $institution,
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

    public function delete($id){
        try{

            $delete = $this->repository->delete($id);

            return [
                'success' => true,
                'message' =>'Instituicao removida com sucesso',                
            ];

        }
        catch(\Exception $e){
            return [
                'success' => false,
                'message' => $e->getMessage() . 'Houve um erro na remocao do Usuario',
                
            ];
        }
    }

}