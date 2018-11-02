@extends('layouts.app')

@section('content')
                <div class="card-header">Registrar Novo Grupo</div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert <?= session('success')['success'] ? 'alert-success' : 'alert-danger'?> " role="alert">
                            {{ session('success')['message'] }}
                        </div>
                    @endif

                    {!! Form::open(['route'=> 'group.store', 'method'=> 'post', 'class' => 'form-group']) !!}
                        @include('layouts.input', ['label' => 'Nome do Grupo', 'input' => 'name', 'atributes'=> ['placeholder' => 'Novo Grupo', 'class' => 'form-control']])
                        @include('layouts.select', ['label' => 'Gestor do grupo', 'select' => 'user_id', 'data' => $userData, 'atributes'=> ['placeholder' => 'Selecione o Gestor do grupo', 'class' => 'form-control']])
                        @include('layouts.select', ['label' => 'Instituicao', 'select' => 'institution_id', 'data' => $institutionData,'atributes'=> ['placeholder' => 'Selecione a Instituicao', 'class' => 'form-control']])                     
                        @include('layouts.submit', ['input' => 'Cadastrar', 'atributes'=> ['class' => 'btn btn-success', 'type' => 'submit']])
                    {!! Form::close() !!}     
                    
                </div>
                    @include('groups.list', ['groupList' => $group])
   
@endsection