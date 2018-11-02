@extends('layouts.app')

@section('content')

            <div class="card-header">Grupos Registrados {{ $institution->name }}</div>
                
            @include('groups.list', ['groupList' => $institution->group])

@endsection