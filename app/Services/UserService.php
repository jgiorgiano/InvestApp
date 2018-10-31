<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class UserService
{

    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;

    }

    public function store($data){

        try{
            
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);// copiado do UsersController
           

            $usuario = $this->repository->create([
                'name'  => $data['name'],
                'cpf'   => $data['cpf'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'password' => \Hash::make($data['password']),
            ]);

            return [
                'success' => true,
                'message' =>'Registro efetuado com sucesso',
                'data' => $usuario,
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

        try{
            
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $update = $this->repository->update($data, $id);   
                  

            return [
                'success' => true,
                'message' =>'Cadastro Atualizado com sucesso',
                'data' => null,
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

            $usuario = $this->repository->delete($id);

            return [
                'success' => true,
                'message' =>'Usuario removido com sucesso',                
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