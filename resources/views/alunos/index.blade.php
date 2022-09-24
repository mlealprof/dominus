<x-layout title="Alunos">
    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight">
            <a href="{{ route('aluno.create') }}" class="btn btn-outline-primary">Novo Aluno</a>
        </div>
    </div>

        <table id="tableProfessores" class="display table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Matricula</th>
                    <th>Nome</th>
                    <th>Turma</th>
                    <th>Email</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alunos as $aluno)
                <tr>
                    <td>{{ $aluno->matricula }}</td>
                    <td>{{ $aluno->nome }}</td>
                    <td></td>
                    <td>{{ $aluno->email }}</td>
                    <td>
                        <a href="{{ url('alunos\/') .$aluno->id .'/editar'}}" class="btn btn-outline-secondary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="#" class="btn btn-outline-danger btn-sm btn-excluir"
                            data-professor = {{$aluno}}
                            data-route = "{{ route('aluno.destroy',['aluno'=>$aluno]) }}"
                            data-id="{{ $aluno->id }}"
                            data-nome="{{ $aluno->nome }}"
                            data-rota="{{ route('aluno.destroy',['aluno'=>$aluno]) }}">
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
                <h5 class="modal-title">Excluir Aluno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p class="text-center">Confirma a exclusão do aluno?</p>
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
