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
        $products = $this->repository->all();
        $institution = Institution::find($institution_id); // isso funciona pq add o model pra usar nesse controller.        

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
    public function edit($id)
    {
        $product = $this->repository->find($id);

        return view('products.edit', compact('product'));
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
    public function update(ProductsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $product = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Products updated.',
                'data'    => $product->toArray(),
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
                'message' => 'Products deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Products deleted.');
    }
}
