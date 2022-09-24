<x-layout title="{{$turma->nome}} - Professores">
    <form class="needs-validation" action="{{ route('turma.professor.store') }}" method="post">
        @csrf
        <div class="row g-4">
            <input type="hidden" name="turma_id" value="{{$turma->id}}">
            <div class="col-sm-4">
                <label class="form-label">*Professores</label>
                <select class="form-select" id="aluno_id" name="professor_id">
                    <option value="0">Selecione...</option>
                    @foreach ($todosProfessores as $listaProfessor)
                        <option value="{{$listaProfessor->id}}">{{$listaProfessor->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <label class="form-label">*Disciplina</label>
                <select class="form-select" id="disciplina" name="disciplina">
                    <option value="0">Selecione...</option>
                    @foreach ($disciplinas as $disciplina)
                        <option value="{{$disciplina->nome}}">{{$disciplina->nome}}</option>
                    @endforeach
                </select>
            </div>

<!-- 
        <div class="col-sm-2">
                <label class="form-label">Dia da semana</label>
                <select class="form-select" id="dia_semana" name="dia_semana">
                    <option value="0">Selecione...</option>
                    <option value="Segunda-Feira">Segunda-Feira</option>
                    <option value="Terça-Feira">Terça-Feira</option>
                    <option value="Quarta-Feira">Quarta-Feira</option>
                    <option value="Quinta-Feira">Quinta-Feira</option>
                    <option value="Sexta-Feira">Sexta-Feira</option>
                    <option value="Sábado">Sábado</option>
                    <option value="Domingo">Domingo</option>
                </select>
            </div>


            <div class="col-sm-3">
                <label class="form-label">Aula (horario)</label>
                <select class="form-select" id="horario" name="horario">
                    <option value="0">Selecione...</option>
                    @foreach ($horarios as $horario)
                        <option value="{{$horario->aula}} - ( {{$horario->hora_inicio}} - {{$horario->hora_fim}} )">{{$horario->aula}} - ( {{$horario->hora_inicio}} - {{$horario->hora_fim}} )</option>
                    @endforeach
                </select>
            </div>
-->
            <div class="col-3 align-self-end">
                <button class="btn btn-primary btn-store" type="submit">Incluir professor</button>
            </div>
        </div>
    </form>
    <br>

    <table class="display table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Professor</th>
                <th>Disciplina</th>
                <th>Dia da semana</th>
                <th>Aula(Horario)</th>
                <th class="text-end"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($professores as $professor)
            <tr>
                @foreach ($todosProfessores as $listaProfessor)
                    @if($listaProfessor->id == $professor->professor_id)
                        <td>{{ $listaProfessor->nome }}</td>
                        <td>{{$professor->disciplina}}</td>
                        <td>{{$professor->dia_semana}}</td>
                        <td>{{$professor->horario}}</td>
                        <td class="text-end">
                            <a href="#" class="btn btn-danger btn-sm btn-excluir" data-nome="{{$listaProfessor->nome}}" data-rota="{{ route('turma.professor.destroy',['turma'=>$turma,'professor'=>$professor->id]) }}">
                                <i class="fa fa-trash" aria-hidden="true"></i>
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
            <h5 class="modal-title">Excluir professor</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-center">Confirma a exclusão do professor?</p>
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
