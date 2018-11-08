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
                            @if(isset($moviment_list->value))
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
                                        <th colspan="4"> Valor Total Investido</th>                                                             
                                        <th>{{ $moviment->product->getTotal(Auth::user()) }}</th>                                    
                                    </tr>
                                @else 
                                    <tr>
                                        <th colspan="5"> Nenhuma movimentacao Registrada </th>                                    
                                    </tr>
                            @endif    
                        </tbody>
                        </table>
                </div>
 
@endsection