@extends('layouts.app')

@section('content')
                <div class="card-header">Resgatar Investimento</div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert <?= session('success')['success'] ? 'alert-success' : 'alert-danger'?> " role="alert">
                            {{ session('success')['message'] }}
                        </div>
                    @endif

                    {!! Form::open(['route'=> 'moviments.getBack.store', 'method'=> 'post', 'class' => 'form-group']) !!}
                        @include('layouts.select', ['label' => 'Grupos', 'select' => 'group_id', 'data' => $groupList, 'atributes'=> ['placeholder' => 'Selecione o grupo', 'class' => 'form-control']])
                        @include('layouts.select', ['label' => 'Produtos', 'select' => 'product_id', 'data' => $productList,'atributes'=> ['placeholder' => 'Selecione o produto', 'class' => 'form-control']])                     
                            <h5> Valor Disponivel a ser Resgatado:</h5>
                            {{-- inserir ajax/Axios para pegar valor do produto selecionado  --}}
                        @include('layouts.input', ['label' => 'Valor', 'input' => 'value', 'atributes'=> ['placeholder' => 'Valor a ser resgatado', 'class' => 'form-control']])
                        @include('layouts.submit', ['input' => 'Confirmar Resgate', 'atributes'=> ['class' => 'btn btn-success', 'type' => 'submit']])
                    {!! Form::close() !!}     
                    
                </div>
                    
   
@endsection