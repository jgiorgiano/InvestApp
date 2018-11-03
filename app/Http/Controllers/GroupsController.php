<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Repositories\GroupRepository;
use App\Validators\GroupValidator;
use App\Services\GroupService;
use App\Repositories\UserRepository;
use App\Repositories\InstitutionsRepository;

/**
 * Class GroupsController.
 *
 * @package namespace App\Http\Controllers;
 */
class GroupsController extends Controller
{
    /**
     * @var GroupRepository
     */
    protected $repository;

    /**
     * @var GroupValidator
     */
    protected $validator;

    /**
     * GroupsController constructor.
     *
     * @param GroupRepository $repository
     * @param GroupValidator $validator
     */
    public function __construct(GroupRepository $repository, GroupValidator $validator, GroupService $service, UserRepository $UserRepository, InstitutionsRepository $InstitutionsRepository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service  = $service;
        $this->UserRepository = $UserRepository;
        $this->InstitutionsRepository = $InstitutionsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $groups = $this->repository->all();
        $userData = $this->UserRepository->all()->pluck('name', 'id');
        $institutionData = $this->InstitutionsRepository->all()->pluck('name', 'id');
       

        return view('groups.index', 
        [   'group' => $groups,
            'userData' => $userData,
            'institutionData' => $institutionData,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(GroupCreateRequest $request)
    {
       $request = $this->service->store($request->all());

       $group = $request['success'] ? $request['data'] : null;

       session()->flash('success',[ 
        'success'   => $request['success'],
        'message'      => $request['message'],
       ]);

       return redirect()->route('group.index');

    }

     /**
     * Store the link user to the group.
     **/

    public function userStore(GroupCreateRequest $request, $group_id) //$group_id pode ser qualqu nome, ele traz o valor que foi passado na url.
    {

       $request = $this->service->userStore($group_id, $request->all());

       //$group = $request['success'] ? $request['data'] : null;

       session()->flash('success',[ 
        'success'   => $request['success'],
        'message'      => $request['message'],
       ]);

       return redirect()->back();

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
        $group = $this->repository->find($id);
        $user = $this->UserRepository->all()->pluck('name', 'id');              
        
        return view('groups.show', [
            'group' => $group,
            'userList' => $user,            
        ]);
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
        $group = $this->repository->find($id);
        $userData = $this->UserRepository->all()->pluck('name', 'id');
        $institutionData = $this->InstitutionsRepository->all()->pluck('name', 'id');

        return view('groups.edit', [
            'group' => $group,
            'userData' => $userData,
            'institutionData' => $institutionData,                       
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GroupUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(GroupUpdateRequest $request, $id)
    {
        $update = $this->service->update($request->all(), $id);

        session()->flash('success', [
            'success' => $update['success'],
            'message' => $update['message'],
        ]);

        return redirect()->route('group.index');
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
        $deleted = $this->service->delete($id);
        
       session()->flash('success',[ 
        'success'   => $deleted['success'],
        'message'      => $deleted['message'],
       ]);

       return redirect()->back();
    }
}
