<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use App\Services\UserService;

/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    protected $service;
    /* 
    
     * UsersController constructor.
     *
     * @param UserRepository $repository
     
     */
    public function __construct(UserRepository $repository, UserService $service)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->service = $service;
       
    }

    public function index()
    {
        
        $users = $this->repository->all();
        
       return view('users.index', [
             'users' => $users
       ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UserCreateRequest $request)  {
      
        $request = $this->service->store($request->all());
        
        $usuario = $request['success'] ? $request['data'] : $usuario = null;              
       
        session()->flash('success', [
               'success' => $request['success'],
               'message' => $request['message'],
        ]);
       
       return redirect()->route('user.index');
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $user,
            ]);
        }

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);       

        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UserUpdateRequest $request, $id)
    {
            $update = $this->service->update($request, $id); 
            
            //$usuario = $request['success'] ? $request['data'] : $usuario = null;

                session()->flash('success', [
                       'success' => $update['success'],
                       'message' => $update['message'],
                ]);
               
               return redirect()->route('user.index');
         
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delete = $this->service->delete($id);
      

         session()->flash('success', [
                'success' => $delete['success'],
                'message' => $delete['message'],
         ]);

         return redirect()->route('user.index');



        /* $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]); 
        }

        return redirect()->back()->with('message', 'User deleted.');*/
    }
}
