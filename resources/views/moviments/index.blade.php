@extends('layouts.app')

@section('content')

                <div class="card-header">Relatorio de Investimentos</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert <?= session('success')['success'] ? 'alert-success' : 'alert-danger'?> " role="alert">
                            {{ session('success')['message'] }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Produto</th>
                                <th scope="col">Instituicao</th>                           
                                <th scope="col">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products_list as $product)
                                <tr>                                                                       
                                    <td>{{ $product->name}}</td>                                    
                                    <td>{{ $product->institution->name}}</td>
                                    <td>{{ $product->valueFromUser(Auth::user())}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th> Valor Total Investido</th>   
                                <td></td>                             
                                <th>{{ $product->getTotal(Auth::user()) }}</th>
                               
                            </tr>
                        </tbody>

                        </table>
                </div>
 
@endsection