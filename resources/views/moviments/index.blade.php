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
                                @if($product->valueFromUser(Auth::user())!= 0 ) 
                                    <tr>                                                                       
                                        <td>{{ $product->name}}</td>                                    
                                        <td>{{ $product->institution->name}}</td>
                                        <td>{{ 'R$ ' . number_format($product->valueFromUser(Auth::user()), 2 , "," , "." )}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <th> Valor Total Investido</th>   
                                <td></td>                             
                                <th>{{ 'R$ ' . number_format( $product->getTotal(Auth::user()), 2 , "," , ".")  }}</th>
                               
                            </tr>
                        </tbody>

                        </table>
                </div>
 
@endsection