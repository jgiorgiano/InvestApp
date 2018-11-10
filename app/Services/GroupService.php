<?php

namespace App\Services;

use App\Repositories\GroupRepository;
use App\Validators\GroupValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class GroupService
{

    private $repository;
    private $validator;

    public function __construct(GroupRepository $repository, GroupValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;

    }

    public function store($data){

        try{
            
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);// copiado do GroupController

            $group = $this->repository->create($data);

            return [
                'success' => true,
                'message' => 'Grupo Cadastrado com Sucesso',
                'data' => $group,
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

    public function userStore($group_id, $data){
        
        try{    
            $group      = $this->repository->find($group_id);       // faz a busca do grupo correto pelo id que foi passado na url
            $user_id    = $data['user'];                            // pega o id do usuario que foi passado na request
            $group->users()->attach($user_id);                      // pega o grupo selecionado acima e usa o methodo users
                                                                    //(belongs to many/dentro do model)  e faz o attach do user_id 

            return [
                'success' => true,
                'message' => 'Usuario incluido ao grupo com Sucesso',
                'data' => $group,
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

    public function update($data, $id){
       
        $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

        $update = $this->repository->update($data, $id);

        return [
            'success' => true,
            'message' => 'Grupo Atualizado com sucesso',
            'data' => $update,
        ];

    }

    public function delete($id){
        try{

            $delete = $this->repository->delete($id);

            return [
                'success' => true,
                'message' =>'Grupo removido com sucesso',                
            ];

        }
        catch(\Exception $e){           
            switch (get_class($e)) {
                case QueryException::Class      : return ['success' => false, 'message' => $e->getMessage() . 'Houve um erro no processo'];                 
                    break;
                case ValidatorException::Class  : return ['success' => false, 'message' => $e->getMessageBag() . 'Houve um erro no processo'];                 
                    break;
                case Exception::Class           : return ['success' => false, 'message' => $e->getMessage() . 'Houve um erro no processo'];                 
                    break;                
                default                         : return ['success' => false, 'message' => $e->getMessage() . 'Houve um erro no processo'];
                    break;
                }
        }

    }

    public function userDelete($group_id, $user_id){
        
        try{    
            $group      = $this->repository->find($group_id);       // faz a busca do grupo correto pelo id que foi passado na url
            $group->users()->detach($user_id);                      // pega o grupo selecionado acima e usa o methodo users
                                                                    //(belongs to many/dentro do model)  e faz o attach do user_id 

            return [
                'success' => true,
                'message' => 'Usuario removido do grupo com Sucesso',
                'data' => $group,
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