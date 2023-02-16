<x-layout title="Usuários">
    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight">
            <a href="{{ route('usuarios.create') }}" class="btn btn-outline-primary">Novo Usuário</a>
        </div>
    </div>

   <table id="tableUsuarios" class="display table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>                
                <th>CPF</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->cpf }}</td>                
                <td>
                    Editar
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</x-layout>
