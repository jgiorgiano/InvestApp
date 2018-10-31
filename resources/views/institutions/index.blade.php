@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content">
        <div class="col-md-2 px-0">
            @include('Includes.menuLateral')
        </div>
        <div class="col-md-8 offset-md-1 pt-2">
            <div class="card">
                <div class="card-header">Registrar Nova Instituicao</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert <?= session('success')['success'] ? 'alert-success' : 'alert-danger'?> " role="alert">
                            {{ session('success')['message'] }}
                        </div>
                    @endif

                    {!! Form::open(['route'=> 'institution.store', 'method'=> 'post', 'class' => 'form-group']) !!}
                        @include('layouts.input', ['label' => 'Nome da Instituicao', 'input' => 'name', 'atributes'=> ['placeholder' => 'Nome', 'class' => 'form-control']])                        
                        @include('layouts.submit', ['input' => 'Cadastrar', 'atributes'=> ['class' => 'btn btn-success', 'type' => 'submit']])
                    {!! Form::close() !!}



                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome da Instituicao</th>                           
                                <th scope="col">Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($institutions as $inst)
                                <tr>
                                    <th scope="row">{{ $inst->id }}</th>
                                    <td>{{ $inst->name}}</td>                                    
                                    <td>
                                        {!! Form::open(['route'=> ['institution.destroy', $inst->id], 'method' => 'DELETE']) !!} 
                                            {!! Form::button("Remover", ['class' => 'btn btn-sm btn-warning', 'type' => 'submit'] ) !!}  
                                        {!! Form::close() !!}
                                        <a href="{{ route('institution.show', $inst->id )}}" class="btn btn-sm btn-primary">+ Detalhes</a>
                                        <a href="{{ route('institution.edit', $inst->id )}}" class="btn btn-sm btn-info">Editar</a>                                
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>



                </div>
            </div>        
        </div>
    </div>
</div>
@endsection