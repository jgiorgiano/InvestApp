@extends('layouts.app')

@section('content')
                <div class="card-header">Investir</div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert <?= session('success')['success'] ? 'alert-success' : 'alert-danger'?> " role="alert">
                            {{ session('success')['message'] }}
                        </div>
                    @endif

                    {!! Form::open(['route'=> 'moviments.invest.store', 'method'=> 'post', 'class' => 'form-group']) !!}
                        @include('layouts.select', ['label' => 'Grupos', 'select' => 'group_id', 'data' => $groupList, 'atributes'=> ['placeholder' => 'Selecione o grupo', 'class' => 'form-control']])
                        @include('layouts.select', ['label' => 'Produtos', 'select' => 'product_id', 'data' => $productList,'atributes'=> ['placeholder' => 'Selecione o produto', 'class' => 'form-control']])                     
                        @include('layouts.input', ['label' => 'Valor', 'input' => 'value', 'atributes'=> ['placeholder' => 'Valor a ser Investido', 'class' => 'form-control']])
                        @include('layouts.submit', ['input' => 'Confirmar', 'atributes'=> ['class' => 'btn btn-success', 'type' => 'submit']])
                    {!! Form::close() !!}     
                    
                </div>
                    
   
@endsection