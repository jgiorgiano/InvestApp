<table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nome do Grupo</th>
            <th scope="col">Gestor do Grupo</th>
            <th scope="col">Instituicao</th>                            
            <th scope="col">Menu</th>
            </tr>
        </thead>
        <tbody>
             @foreach($groupList as $group)
                <tr>                    
                <th scope="row">{{ $group->id }}</th>
                <td>{{ $group->name}}</td>
                <td>{{ $group->user->name}} </td>    {{-- isso funciona pq criou o relacionamento no model/Entity do grupo --}}
                <td>{{ $group->institution->name}}</td>          {{-- isso funciona pq criou o relacionamento no model/Entity do grupo --}}                      
                <td>
                    {!! Form::open(['route'=> ['group.destroy', $group->id], 'method' => 'DELETE']) !!} 
                        {!! Form::button("Remover", ['class' => 'btn btn-sm btn-warning', 'type' => 'submit'] ) !!}                        
                    {!! Form::close() !!}
                <a href="{{ route('group.show', $group->id) }}" class="btn btn-sm btn-primary">+ Detalhes</a>
                <a href="{{ route('group.edit', $group->id) }}" class="btn btn-sm btn-info">Editar</a>                                    
                </td>
                </tr>
            @endforeach 
        </tbody>
        </table>