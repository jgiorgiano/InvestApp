<table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nome do Grupo</th>
            <th scope="col">Total Investidos</th>
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
                <td>R$ {{ number_format($group->TotalInvest, 2, ",", ".") }}</td>
                <td>{{ $group->user['name']}}</td>    {{-- isso funciona pq criou o relacionamento no model/Entity do grupo --}}
                <td>{{ $group->institution->name}}</td>          {{-- isso funciona pq criou o relacionamento no model/Entity do grupo --}}                      
                <td>
                    <a href="{{ route('group.show', $group->id) }}" class="btn btn-sm btn-primary">+ Participantes</a>
                    <a href="{{ route('group.edit', $group->id) }}" class="btn btn-sm btn-info">Editar</a>                                    
                    {!! Form::open(['route'=> ['group.destroy', $group->id], 'method' => 'DELETE', 'class' => 'formInline']) !!} 
                        {!! Form::button("Remover", ['class' => 'btn btn-sm btn-warning', 'type' => 'submit'] ) !!}                        
                    {!! Form::close() !!}
                </td>
                </tr>
            @endforeach 
        </tbody>
        </table>