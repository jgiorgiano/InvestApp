<table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">CPF</th>
        <th scope="col">Nome</th>
        <th scope="col">E-mail</th>
        <th scope="col">Telefone</th>
        <th scope="col">Menu</th>
        </tr>
    </thead>
    <tbody>
        @foreach($userList as $user)
            <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->FormatedCpf}}</td>
            <td>{{ $user->FormatedName }}</td>
            <td>{{ $user->email}}</td>
            <td>{{ $user->FormatedPhone}}</td>
            <td>
                {!! Form::open(['route'=> ['user.destroy', $user->id], 'method' => 'DELETE']) !!} 
                    {!! Form::button("Remover", ['class' => 'btn btn-sm btn-warning', 'type' => 'submit'] ) !!}  
                {!! Form::close() !!}    
            <a href="{{route('user.edit', $user->id)}}" class="btn btn-info btn-sm">Editar</a>                               
            </td>
            </tr>
        @endforeach
    </tbody>
    </table>