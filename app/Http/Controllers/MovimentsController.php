<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
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
use App\Services\MovimentsService;

/**
 * Class MovimentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class MovimentsController extends Controller
{
    /**
     * @var MovimentRepository
     */
    protected $repository;

    /**
     * @var MovimentValidator
     */
    protected $validator;

    protected $service;

    /**
     * MovimentsController constructor.
     *
     * @param MovimentRepository $repository
     * @param MovimentValidator $validator
     */
    public function __construct(MovimentRepository $repository, MovimentValidator $validator, MovimentsService $service)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service    = $service;
    }


    public function index(){    

        return view('moviments.index', [
            'products_list' => Products::all(),
            'moviment' => Moviment::all(),
        ]);
    }
    
    public function all(){
        return view('moviments.all', [
            'moviment_list' => Auth::user()->moviments,
            'moviment' => Moviment::class,
        ]);
    }

    public function investing(){ 

        $user = Auth::user(); // recupera os dados do usuario logado no sistema       

        // $groupList      = Group::all()->pluck('name', 'id');     Recupera todo os grupos cadastrados no sistema
        $groupList      = $user->groups->pluck('name', 'id');       // Recupera dados do usuario->chama relacionamento groups no model -> traz dados selecionados
        $productList    = Products::all()->pluck('name', 'id');              

        return view('moviments.investing',[
            'groupList' => $groupList,
            'productList' => $productList,
        ]);

    }

    public function storeInvest(Request $request){
      
        $request = $this->service->storeInvest($request->all(), Auth::user()->id, Products::all()->pluck('name', 'id'));

        session()->flash('success', [
            'success' => $request['success'],
            'message' => $request['message']
        ]);

        return redirect()->route('moviments.invest');    

    }

    public function getBack(){ 

        $user = Auth::user(); // recupera os dados do usuario logado no sistema       

        // $groupList      = Group::all()->pluck('name', 'id');     Recupera todo os grupos cadastrados no sistema
        $groupList      = $user->groups->pluck('name', 'id');       // Recupera dados do usuario->chama relacionamento groups no model -> traz dados selecionados
        $productList    = Products::all()->pluck('name', 'id');

        return view('moviments.getBack',[
            'groupList' => $groupList,
            'productList' => $productList,
        ]);

    }


    public function getBackStore(Request $request){       
      
        $request = $this->service->getBackStore($request->all(), Auth::user()->id, Products::all()->pluck('name', 'id'));        

        session()->flash('success', [
            'success' => $request['success'],
            'message' => $request['message']
        ]);

        return redirect()->route('moviments.getBack');    

    }

    













    /**
     * Store a newly created resource in storage.
     *
     * @param  MovimentCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MovimentCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $moviment = $this->repository->create($request->all());

            $response = [
                'message' => 'Moviment created.',
                'data'    => $moviment->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $moviment = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $moviment,
            ]);
        }

        return view('moviments.show', compact('moviment'));
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
        $moviment = $this->repository->find($id);

        return view('moviments.edit', compact('moviment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MovimentUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MovimentUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $moviment = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Moviment updated.',
                'data'    => $moviment->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Moviment deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Moviment deleted.');
    }
}
