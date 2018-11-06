<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Auth;
use Illuminate\Support\Facades\Hash;

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
                'password' => Hash::make($data['password']),
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
    public function update($request, $id){

        try{ 
            
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);            

            if(\Hash::check($request->oldPassword, Auth::user()->password))
            
                $update = $this->repository->update($request->all(), $id);

                if(isset($request->newPassword)){
                $request->user()->fill([
                    'password' => Hash::make($request->newPassword)
                ])->save();
                }

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

}