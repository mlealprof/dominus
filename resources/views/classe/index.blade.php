<x-layout title="Turmas">
    <form class="needs-validation" action="{{route('classe.store')}}" method="post">
        @csrf
        <div class="row g-3">
            <div class="col-sm-3">
                <label class="form-label">*Nome</label>
                <input type="text" class="form-control" name="nome" id="nome">
            </div>

            <div class="col-sm-3">
                <label class="form-label">*Curso</label>
                <select class="form-select" id="curso_id" name="curso_id" disabled>
                    <option value="0">Selecione...</option>
                    @foreach ($cursos as $curso)
                        <option value="{{$curso->id}}">{{$curso->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-3">
                <label class="form-label">*Modulo</label>
                <select class="form-select" id="modulo_id" name="modulo_id" disabled>
                    <option value="0">Selecione...</option>
                    @foreach ($modulos as $modulo)
                        <option value="{{$modulo->id}}">{{$modulo->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-3 align-self-end">
                <button class="btn btn-outline-primary" type="submit" id="btnNovo" disabled>Cadastrar Turma</button>
            </div>
        </div>
    </form>
    <br>

    <table id="tableProfessores" class="display table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Curso</th>
                <th>Modulo</th>
                <th>Turma</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classes as $classe)
            <tr>

                @foreach ($cursos as $curso)
                    @if($classe->curso == $curso->id)
                        <td>{{ $curso->nome }}</td>
                    @endif

                @endforeach

                @foreach ($modulos as $modulo)
                    @if($classe->modulo == $modulo->id)
                        <td>{{ $modulo->nome }}</td>
                    @endif
                @endforeach

                <td>{{ $classe->nome }}</td>
                <td>
                    <a href="#" class="btn btn-primary btn-sm btn-professores"
                        >
                        Professores
                    </a>
                    <a href="#" class="btn btn-info btn-sm btn-adicionar-aluno"

                        data-Nome           ="{{ $classe->nome }}"
                        data-curso          ="{{ $classe->curso }}"
                        data-modulo         ="{{ $classe->modulo }}"
                        data-alunos         ="{{ $classe->alunos }}"
                        data-professores    ="{{ $classe->professores }}"
                        data-rota="{{ route('classe.update',['classe'=>$classe]) }}">
                        Adicionar alunos
                    </a>
                    <a href="#" class="btn btn-success btn-sm btn-editar"
                        data-nome="{{$classe->nome}}"
                        data-curso_id="{{$classe->curso}}"
                        data-modulo_id="{{$classe->modulo}}"
                        data-rota="{{ route('classe.update',['classe'=>$classe]) }}">
                        Alterar
                    </a>
                    <a href="#" class="btn btn-danger btn-sm btn-excluir"
                        data-professor = {{$classe}}
                        data-route = "{{ route('classe.destroy',['classe'=>$classe]) }}"
                        data-id="{{ $classe->id }}"
                        data-nome="{{ $classe->nome }}"
                        data-rota="{{ route('classe.destroy',['classe'=>$classe]) }}">
                        Excluir
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal excluir - Inicio -->
    <div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Excluir classe</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-center">Confirma a exclusão da classe?</p>
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
    <!-- Modal excluir - Fim -->

    <!-- Modal editar - Inicio -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Classe</uh5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="needs-validation" action="" method="post" id="formEditar">
              <div class="modal-body">
                  @csrf
                  @method('put')
                  <div class="row g-3">
                      <div class="col-sm-12">
                          <label class="form-label">Nome da classe</label>
                          <input type="text" class="form-control" name="nome" id="editarNome"required>
                      </div>
                      <div class="col-sm-12">
                          <label class="form-label">*Curso</label>
                          <select class="form-select" id="editarCursoId" name="curso_id">
                              <option value="0">Selecione</option>
                              @foreach ($cursos as $curso)
                                  <option value="{{$curso->id}}">{{$curso->nome}}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-sm-12">
                          <label class="form-label">*Modulo</label>
                          <select class="form-select" id="editarModuloId" name="modulo_id">
                              <option value="0">Selecione...</option>
                              @foreach ($modulos as $modulo)
                                  <option value="{{$modulo->id}}">{{$modulo->nome}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button class="btn btn btn-danger" type="submit">Salvar</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal editar - Fim -->

    <!-- Modal adicionar aluno - Inicio -->
    <div class="modal fade" id="modalAdicionarAluno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Adicionar aluno</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="needs-validation" method="post" id="formAddAluno">
              <input type="hidden" name="nome" value="" id="formAddAlunoNome">
              <input type="hidden" name="curso_id" value="" id="formAddAlunoCurso">
              <input type="hidden" name="modulo_id" value="" id="formAddAlunoModulo">
              <div class="modal-body">
                  @csrf
                  @method('put')
                  <div class="row g-3">
                      <div class="input-group">
                          <select class="form-select" id="formAddAlunoSelect">
                              <option selected value="0">Selecione...</option>
                              @foreach ($alunos as $aluno)
                                  <option value="{{$aluno->id}} - {{$aluno->nome}}">{{$aluno->matricula}} - {{$aluno->nome}}</option>
                              @endforeach
                          </select>
                          <button class="btn btn-outline-primary" type="button" id="btnInsertAluno" onclick="insertAluno()" disabled>Adiciona aluno</button>
                      </div>


                  </div>
                  <hr>
                  <!-- Listagem de alunos da classe-->

                      <h6># Lista de alunos</h6>
                    <ul class="mt-3 list-group list-group-horizontal">
                        <li class="col-2 list-group-item list-group-item-secondary"><b>Matricula</b></li>
                        <li class="col-10 list-group-item list-group-item-secondary"><b>Nome</b></li>
                    </ul>
                      <ul class="list-group ps-1 pe-1 pb-3" id="listaAlunos">

                      </ul>

              </div>
              <div class="modal-footer">
                <button class="btn btn btn-danger" type="submit">Salvar</button>
              </div>
          </form>
          <br>




        </div>
      </div>
    </div>
    <!-- Modal editar - Fim -->

    <script type="text/javascript">

        //Excluir Registro
        $( ".btn-excluir" ).on( "click", function() {
            let modal = document.getElementById('modalExcluir')
            let modalName = modal.querySelector('.modal-body h3')
            let form = document.getElementById('formDeleteUser')
            form.action = $(this).data('rota')
            modalName.textContent = $(this).data('nome')
            $('#modalExcluir').modal('show');
        });

        //Editar Turma Capa
        $( ".btn-editar" ).on( "click", function() {
            let form = document.getElementById('formEditar')
            let txtNome = document.getElementById('editarNome')
            let txtCurso = document.getElementById('editarCursoId')
            let txtModulo = document.getElementById('editarNomeId')
            txtNome.value = $(this).data('nome')
            $('#editarCursoId').val($(this).data('curso_id'))
            $('#editarModuloId').val($(this).data('modulo_id'))

            form.action = $(this).data('rota')
            $('#modalEditar').modal('show');
        });

        //Adicionar aluno a turma
        $( ".btn-adicionar-aluno" ).on( "click", function() {
            // Busca o formulario de adicionar aluno e adicona a rota com o id da turma
            let form = document.getElementById('formAddAluno')
            form.action = $(this).data('rota')

            $("#formAddAlunoNome").val($(this).data('nome'))
            $("#formAddAlunoCurso").val($(this).data('curso'))
            $("#formAddAlunoModulo").val($(this).data('modulo'))



            // lista os alunos da turma
            let listaAlunos = $(this).data('alunos').split(";")
            $( "#listaAlunos").empty()
            listaAlunos.forEach((item, i) => {
                $( "#listaAlunos" ).append(
                    "<li class='list-group-item d-flex justify-content-between align-items-center'>" +
                    item +
                    "<button class='btn btn-sm btn-outline-danger'>Remover</button>" +
                    "</li>"
                );
            });

            // Abre a janela de edição
            $('#modalAdicionarAluno').modal('show');

        });

        // Valida o campo nome
        $( "#nome" )
          .keyup(function() {
             // verifica se possui mais de 5 caracteres
            if ($(this).val().length >= 5)
            {
                $(this).addClass('is-valid')
                $( "#curso_id" ).prop( "disabled", false)
            } else {
                $(this).removeClass('is-valid')
                $( "#curso_id" ).prop( "disabled", true ).removeClass('is-valid')
            }
          })
          .keyup();

          // Valida o campo curso
          $('#curso_id').change(function(e){
              let value = $('#curso_id').val()
              if (value > 0) {
                  $(this).addClass('is-valid')
                  $( "#modulo_id" ).prop( "disabled", false ).focus();
              } else {
                  $(this).removeClass('is-valid')
                  $( "#modulo_id" ).val('').prop( "disabled", true );
              }
          });

          // Valida o campo modulo
          $('#modulo_id').change(function(e){
              let value = $('#curso_id').val()
              if (value > 0) {
                  $(this).addClass('is-valid')
                  $( "#btnNovo" ).prop( "disabled", false ).focus();
              } else {
                  $(this).removeClass('is-valid')
                  $( "#btnNovo" ).val('').prop( "disabled", true );
              }
          });

          // Valida o campo inserir aluno
          $('#formAddAlunoSelect').change(function(e){
              let value = $(this).val()
              console.log(value)
              if (value == 0) {
                  $( "#btnInsertAluno" ).val('').prop( "disabled", true );
              } else {
                  $( "#btnInsertAluno" ).val('').prop( "disabled", false );
              }
          });

          // insere aluno na coluna
          function insertAluno(){

              $( "#listaAlunos" ).append(
                  "<li class='list-group-item d-flex justify-content-between align-items-center'>" +
                  $("#formAddAlunoSelect").val() +
                  "<button class='btn btn-sm btn-outline-danger'>Remover</button>" +
                  "</li>"
              );
              
          }

          // remove aluno na coluna
          function removeAluno(){

          }

    </script>

</x-layout>
