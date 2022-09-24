<x-layout title="{{$turma->nome}} - Alunos">
    <form class="needs-validation" action="{{ route('turma.aluno.store') }}" method="post">
        @csrf
        <div class="row g-3">
            <input type="hidden" name="turma_id" value="{{$turma->id}}">
            <div class="col-sm-5">
                <label class="form-label">*Alunos</label>
                <select class="form-select" id="aluno_id" name="aluno_id">
                    <option value="0">Selecione...</option>
                    @foreach ($todosAlunos as $listaAluno)
                        <option value="{{$listaAluno->id}}">{{$listaAluno->matricula}} - {{$listaAluno->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-3 align-self-end">
                <button class="btn btn-outline-primary btn-store" type="submit">Adicionar aluno</button>
            </div>
        </div>
    </form>
    <br>

    <table class="display table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th class="text-end"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alunos as $aluno)
            <tr>

                @foreach ($todosAlunos as $listaAluno)
                    @if($listaAluno->id == $aluno->aluno_id)
                        <td>{{ $listaAluno->nome }}</td>
                        <td class="text-end">
                            <a href="#" class="btn btn-danger btn-sm btn-excluir" data-nome="{{$listaAluno->nome}}" data-rota="{{ route('turma.aluno.destroy',['turma'=>$turma,'aluno'=>$aluno->id]) }}">
                                Excluir
                            </a>
                        </td>
                    @endif

                @endforeach


            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal excluir -->
    <div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Excluir aluno</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-center">Confirma a exclusão do aluno?</p>
            <h3 class="text-center" id="excluirNome"></h3>
            <p class="text-muted text-center">Não será possivel recuperar o registro.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <form id="formDelete" class="" action="" method="post">
                @csrf
                @method('delete')
                <button class="btn btn btn-danger" type="submit">Excluir</button>
            </form>
          </div>
        </div>
      </div>
    </div>



    <script type="text/javascript">

        //Excluir registro
        $( ".btn-excluir" ).on( "click", function() {
            console.log($(this).data("rota"))
            $('#formDelete').attr('action',$(this).data("rota"))
            $('#excluirNome').html($(this).data('nome'))
            $('#modalExcluir').modal('show');
        });

    </script>

</x-layout>
