@extends('layouts.app')

@section('content')

            <div class="card-header">{{ $institution->name }} > {{ $product->name}}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert <?= session('success')['success'] ? 'alert-success' : 'alert-danger'?> " role="alert">
                            {{ session('success')['message'] }}
                        </div>
                    @endif

                    {!! Form::model($product, ['route'=> ['institution.products.update', $institution->id, $product->id], 'method'=> 'put', 'class' => 'form-group']) !!}
                        @include('layouts.input', ['label' => 'Nome do Produto', 'input' => 'name', 'atributes'=> ['placeholder' => 'Nome', 'class' => 'form-control']])
                        @include('layouts.input', ['label' => 'Descricão', 'input' => 'description', 'atributes'=> ['placeholder' => 'Descricão', 'class' => 'form-control']])
                        @include('layouts.input', ['label' => 'Taxa de juros', 'input' => 'interest_rate', 'atributes'=> ['placeholder' => 'Taxa', 'class' => 'form-control']])
                        @include('layouts.input', ['label' => 'Indexador de Juros', 'input' => 'index', 'atributes'=> ['placeholder' => 'Indexador', 'class' => 'form-control']])                        
                        @include('layouts.submit', ['input' => 'Atualizar', 'atributes'=> ['class' => 'btn btn-success', 'type' => 'submit']])
                    {!! Form::close() !!}                   

                </div>
            
@endsection