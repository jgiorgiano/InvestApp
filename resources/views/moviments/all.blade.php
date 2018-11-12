@extends('layouts.app')

@section('content')

                <div class="card-header">Extrato de Movimentacões Financeiras</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert <?= session('success')['success'] ? 'alert-success' : 'alert-danger'?> " role="alert">
                            {{ session('success')['message'] }}
                        </div>
                    @endif

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Data</th>
                                <th scope="col">Produto</th>                           
                                <th scope="col">Grupo</th>
                                <th scope="col">Resgate</th>
                                <th scope="col">Aplicacão</th>                                                               
                            </tr>
                        </thead>
                        <tbody> 
                            @if(count($moviment_list) > 0)
                                @foreach($moviment_list as $moviment)
                                    <tr {{ $moviment->type == 2 ? "class=table-danger" : 'class=table-success'}}> 
                                        <td>{{ $moviment->created_at->format('d/m/Y H:i')}}</td>                                    
                                        <td>{{ $moviment->product->name}}</td>
                                        <td>{{ $moviment->group->name}}</td>
                                        <td>{{ $moviment->type == 2 ? ' - R$ ' . number_format($moviment->value, 2 , ",", ".") : ''}}</td> 
                                        <td>{{ $moviment->type == 1 ? 'R$ ' . number_format($moviment->value, 2 , ",", ".") : ''}}</td>                                        
                                    </tr>
                                @endforeach
                                    <tr>
                                        <th colspan="4"> Saldo Total Investido</th>                                                             
                                        <th>{{ 'R$ ' . number_format($moviment->product->getTotal(Auth::user()), 2 , ",", ".") }}</th>                                    
                                    </tr>
                                @else 
                                    <tr>
                                        <th colspan="5"> Nenhuma movimento Registrado </th>                                    
                                    </tr>
                            @endif    
                        </tbody>
                        </table>
                </div>
 
@endsection