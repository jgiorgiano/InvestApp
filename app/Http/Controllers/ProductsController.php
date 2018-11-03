<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ProductsCreateRequest;
use App\Http\Requests\ProductsUpdateRequest;
use App\Repositories\ProductsRepository;
use App\Validators\ProductsValidator;
use App\Entities\Institution;
use App\Services\ProductService;

/**
 * Class ProductsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProductsController extends Controller
{
    /**
     * @var ProductsRepository
     */
    protected $repository;

    /**
     * @var ProductsValidator
     */
    protected $validator;
    protected $service;

    /**
     * ProductsController constructor.
     *
     * @param ProductsRepository $repository
     * @param ProductsValidator $validator
     */
    public function __construct(ProductsRepository $repository, ProductsValidator $validator, ProductService $service)
    {
        $this->middleware('auth');
        $this->repository   = $repository;
        $this->validator    = $validator;
        $this->service      = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($institution_id)
    {        
        $institution = Institution::find($institution_id); // isso funciona pq add o model pra usar nesse controller.

        // $products = $this->repository->all(); recupera todos os produtos
        // $product = $this->repository->findWhere(['institution_id' => $institution_id]);
        $products = $institution->products; // melhor forma usando model e seu relacionamentos

        return view('products.index', [
            'products' => $products,
            'institution' => $institution,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ProductsCreateRequest $request, $institution_id)
    {
        $request = $this->service->store($request->all(), $institution_id);

        session()->flash('success', [
            'success' => $request['success'],
            'message' => $request['message'],
        ]);

        return redirect()->route('institution.products.index', $institution_id);
       
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
        $product = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $product,
            ]);
        }

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($institution_id, $product_id)
    {
        $institution = Institution::find($institution_id);
        $product = $institution->products->find($product_id);        

        return view('products.edit', [
            'institution' => $institution,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ProductsUpdateRequest $request, $institution_id, $product_id)
    {
        
        $updated = $this->service->update($request->all(), $institution_id, $product_id);

        session()->flash('success', [
            'success' => $updated['success'],
            'message' => $updated['message'],
        ]);

        return redirect()->route('institution.products.index', $institution_id);



        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($institution_id, $product_id)
    {
        $deleted = $this->service->delete($institution_id, $product_id);

        session()->flash('success', [
            'success' => $deleted['success'],
            'message' => $deleted['message'],
        ]);

        return redirect()->route('institution.products.index', $institution_id);   
       
    }
}
