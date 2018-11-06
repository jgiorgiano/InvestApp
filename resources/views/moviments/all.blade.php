@extends('layouts.app')

@section('content')

                <div class="card-header">Extrato de Movimentacões Financeiras</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert <?= session('success')['success'] ? 'alert-success' : 'alert-danger'?> " role="alert">
                            {{ session('success')['message'] }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Data</th>
                                <th scope="col">Produto</th>                           
                                <th scope="col">Grupo</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Valor</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($moviment_list as $moviment)
                                <tr> 
                                    <td>{{ $moviment->created_at->format('d/m/Y H:i')}}</td>                                    
                                    <td>{{ $moviment->product->name}}</td>
                                    <td>{{ $moviment->group->name}}</td>
                                    <td>{{ $moviment->type == 1 ? 'Aplicacão' : 'Resgate'}}</td>
                                    <td>{{ $moviment->value}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                    <th> Valor Total Investido</th>   
                                    <td></td> <td></td> <td></td>                      
                                    <th>{{ $moviment->product->getTotal(Auth::user()) }}</th>
                                   
                                </tr>
                        </tbody>
                        </table>
                </div>
 
@endsection