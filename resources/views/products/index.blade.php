@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content">
        <div class="col-md-2 px-0">
            @include('Includes.menuLateral')
        </div>
        <div class="col-md-8 offset-md-1 pt-2">
            <div class="card">
            <div class="card-header">{{ $institution->name }} > Produtos</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert <?= session('success')['success'] ? 'alert-success' : 'alert-danger'?> " role="alert">
                            {{ session('success')['message'] }}
                        </div>
                    @endif

                    {!! Form::open(['route'=> ['institution.products.store', $institution->id], 'method'=> 'post', 'class' => 'form-group']) !!}
                        @include('layouts.input', ['label' => 'Nome do Produto', 'input' => 'name', 'atributes'=> ['placeholder' => 'Nome', 'class' => 'form-control']])
                        @include('layouts.input', ['label' => 'Descricão', 'input' => 'description', 'atributes'=> ['placeholder' => 'Descricão', 'class' => 'form-control']])
                        @include('layouts.input', ['label' => 'Taxa de juros', 'input' => 'interest_rate', 'atributes'=> ['placeholder' => 'Taxa', 'class' => 'form-control']])
                        @include('layouts.input', ['label' => 'Indexador de Juros', 'input' => 'index', 'atributes'=> ['placeholder' => 'Indexador', 'class' => 'form-control']])                        
                        @include('layouts.submit', ['input' => 'Cadastrar', 'atributes'=> ['class' => 'btn btn-success', 'type' => 'submit']])
                    {!! Form::close() !!}

                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome do Produto</th>
                            <th scope="col">Descricão</th>
                            <th scope="col">Taxa de juros</th>                            
                            <th scope="col">Indexador</th>
                            <th scope="col">Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                             @forelse($institution->products as $product)
                                <tr>                    
                                <th scope="row">{{ $product->id }}</th>
                                <td>{{ $product->name}}</td>
                                <td>{{ $product->description}}</td>    
                                <td>{{ $product->interest_rate}}</td>          
                                <td>{{ $product->index}}</td>                     
                                <td>
                                    {!! Form::open(['route'=> ['institution.products.destroy', $institution->id, $product->id], 'method' => 'DELETE']) !!} 
                                        {!! Form::button("Remover", ['class' => 'btn btn-sm btn-warning', 'type' => 'submit'] ) !!}                        
                                    {!! Form::close() !!}                                
                                <a href="{{ route('institution.products.edit', [$institution->id, $product->id]) }}" class="btn btn-sm btn-info">Editar</a>                                    
                                </td>
                                </tr>
                            @empty


                            @endforelse
                        </tbody>
                        </table>

                </div>
            </div>        
        </div>
    </div>
</div>
@endsection