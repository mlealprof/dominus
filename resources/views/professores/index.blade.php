<x-layout title="Professores">
    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight">
            <a href="{{ route('professor.create') }}" class="btn btn-outline-primary">Novo Professor</a>
        </div>
    </div>

    <table id="tableProfessores" class="display table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Cidade e Estado</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($professores as $prof)
            <tr>
                <td>{{ $prof->nome }}</td>
                <td>{{ $prof->email }}</td>
                <td>{{ $prof->cidade }} - {{$prof->estado}}</td>
                <td>
                    <a href="{{ url('professores\/') .$prof->id .'/editar'}}" class="btn btn-outline-secondary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="#" class="btn btn-outline-danger btn-sm btn-excluir"
                        data-professor = {{$prof}}
                        data-route = "{{ route('professor.destroy',['professor'=>$prof]) }}"
                        data-id="{{ $prof->id }}"
                        data-nome="{{ $prof->nome }}"
                        data-rota="{{ route('professor.destroy',['professor'=>$prof]) }}">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <!-- Modal excluir professor-->
    <div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Excluir Professor</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-center">Confirma a exclusão do professor?</p>
            <h3 class="text-center"></h3>
            <p class="text-muted text-center">Não será possivel recuperar o registro.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <form id="formDeleteUser" class="" action="" method="post">
                @csrf
                @method('delete')
                <button class="btn btn btn-danger" type="submit">Excluir</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">

        $( ".btn-excluir" ).on( "click", function() {

            let modal = document.getElementById('modalExcluir')
            let modalName = modal.querySelector('.modal-body h3')
            let modalAction = modal.querySelector('.modal-body h3')
            let form = document.getElementById('formDeleteUser')

            form.action = $(this).data('rota')

            modalName.textContent = $(this).data('nome')

            $('#modalExcluir').modal('show');
            console.log( $( this ).data('rota') );
        });

    </script>

</x-layout>
