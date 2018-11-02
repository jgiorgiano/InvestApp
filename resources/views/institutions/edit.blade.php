@extends('layouts.app')

@section('content')

            <div class="card-header">Editar Instituicao: <strong>{{ $institution->name }}</strong></div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert <?= session('success')['success'] ? 'alert-success' : 'alert-danger'?> " role="alert">
                            {{ session('success')['message'] }}
                        </div>
                    @endif

                    {!! Form::model( $institution, ['route'=> ['institution.update', $institution->id], 'method'=> 'put', 'class' => 'form-group']) !!}
                        @include('layouts.input', ['label' => 'Nome da Instituicao', 'input' => 'name', 'atributes'=> ['placeholder' => 'Nome', 'class' => 'form-control']])                        
                        @include('layouts.submit', ['input' => 'Atualizar', 'atributes'=> ['class' => 'btn btn-success', 'type' => 'submit']])
                    {!! Form::close() !!}

                </div>
            
@endsection