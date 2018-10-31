@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content">
        <div class="col-md-2 px-0">
            @include('Includes.menuLateral')
        </div>
        <div class="col-md-8 offset-md-1 pt-2">
            <div class="card">
            <div class="card-header">Grupos Registrados {{ $institution->name }}</div>
                
            @include('groups.list', ['groupList' => $institution->group])



                </div>
            </div>        
        </div>
    </div>
</div>
@endsection