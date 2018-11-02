@extends('layouts.app')

@section('content')

            <div class="card-header">Editar usuario: <strong> {{ $user->name }} </strong></div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert <?= session('success')['success'] ? 'alert-success' : 'alert-danger'?> " role="alert">
                            {{ session('success')['message'] }}
                        </div>
                    @endif

                    {!! Form::model($user, ['route'=> ['user.update', $user->id], 'method'=> 'put', 'class' => 'form-group']) !!}
                        @include('layouts.input', ['label' => 'CPF', 'input' => 'cpf', 'atributes'=> ['placeholder' => 'CPF', 'id' => 'teste', 'class' => 'form-control']])
                        @include('layouts.input', ['label' => 'Nome', 'input' => 'name', 'atributes'=> ['placeholder' => 'Nome', 'class' => 'form-control']])
                        @include('layouts.input', ['label' => 'Telefone', 'input' => 'phone', 'atributes'=> ['placeholder' => 'Telefone', 'class' => 'form-control']])
                        @include('layouts.input', ['label' => 'E-mail', 'input' => 'email', 'atributes'=> ['placeholder' => 'E-mail', 'class' => 'form-control']])
                        @include('layouts.password', ['input' => 'password', 'atributes'=> ['placeholder' => 'Senha', 'class' => 'form-control']])
                        @include('layouts.submit', ['input' => 'Atualizar', 'atributes'=> ['class' => 'btn btn-success', 'type' => 'submit']])
                    {!! Form::close() !!}     
                    
                </div>  
@endsection