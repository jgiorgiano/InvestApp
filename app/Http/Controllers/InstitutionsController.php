<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstitutionsCreateRequest;
use App\Http\Requests\InstitutionsUpdateRequest;
use App\Repositories\InstitutionsRepository;
use App\Validators\InstitutionsValidator;
use App\Services\InstitutionService;

/**
 * Class InstitutionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class InstitutionsController extends Controller
{
    /**
     * @var InstitutionsRepository
     */
    protected $repository;

    /**
     * @var InstitutionsValidator
     */
    protected $validator;

    /**
     * InstitutionsController constructor.
     *
     * @param InstitutionsRepository $repository
     * @param InstitutionsValidator $validator
     */
    public function __construct(InstitutionsRepository $repository, InstitutionsValidator $validator, InstitutionService $service)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $institutions = $this->repository->all();

        
        return view('institutions.index', [
            'institutions' => $institutions
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstitutionsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InstitutionsCreateRequest $request)
    {

        $request        = $this->service->store($request->all());

        $institution    = $request['success'] ? $request['data'] : $instituion = null;            
         

         session()->flash('success', [
                'success' => $request['success'],
                'message' => $request['message'],
         ]);        
        return redirect()->route('institution.index');


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
        $institution = $this->repository->find($id);
        
        return view('institutions.show', [
            'institution' => $institution,
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
        $institution = $this->repository->find($id);

        return view('institutions.edit', [
            'institution' => $institution
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InstitutionsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(InstitutionsUpdateRequest $request, $id)
    {
        $update = $this->service->update($request->all(), $id); 
        
        session()->flash('success', [
            'success' => $update['success'],
            'message' => $update['message'],
        ]);

        return redirect()->route('institution.index');
           
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
            
        return redirect()->route('institution.index');
    }
}
