@extends('layouts.app')

@section('content')
                <div class="card-header">
                    <h5>Grupo: <strong>{{ $group->name }} </strong></h5>
                    <h6>Gestor do Grupo: <strong> {{$group->user->name ?? 'Nao registrado'}} </strong></h6>
                    <h6>Instituicao: <strong>{{$group->institution->name}} </strong></h6>
                </div>
                <div class="card-body">
                    
                    @if (session('success'))
                        <div class="alert <?= session('success')['success'] ? 'alert-success' : 'alert-danger'?> " role="alert">
                            {{ session('success')['message'] }}
                        </div>
                    @endif


                    {!! Form::open(['route'=> ['group.user.store', $group->id], 'method'=> 'post', 'class' => 'form-group']) !!}                        
                        @include('layouts.select', [
                            'label'     => 'Selecione Usuario', 
                            'select'    => 'user', 
                            'data'      => $userList,
                            'atributes' => ['placeholder' => 'Selecione o Usuario', 'class' => 'form-control']])
                        @include('layouts.submit', ['input' => 'Adicionar ao Grupo '. $group->name, 'atributes'=> ['class' => 'btn btn-success', 'type' => 'submit']])
                    {!! Form::close() !!}  

                    @include('users.list', ['userList' => $group->users])

                </div>
        </div>

@endsection