<x-layout title="Turmas">
    <form class="needs-validation mb-3" action="{{route('turma.store')}}" method="post">
        @csrf
        <div class="row g-3 border rounded-3 pb-3 user-select-none">
            <h5 class="text-primary">Criar nova turma</h5>
            <div class="col-sm-3">
                <label class="form-label user-select-none">*Nome</label>
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

            <div class="col-sm-4">
                <label class="form-label">*Modulo</label>
                <select class="form-select" id="modulo_id" name="modulo_id" disabled>
                    <option value="0">Selecione...</option>
                    @foreach ($modulos as $modulo)
                        <option value="{{$modulo->id}}">{{$modulo->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-2 align-self-end text-end ">
                <button class="btn btn-outline-primary" type="submit" id="btnNovo" disabled>Cadastrar Turma</button>
            </div>
        </div>
    </form>

    <table class="display table table-light " style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Curso</th>
                <th>Modulo</th>
                <th>Turma</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($turmas as $turma)
            <tr>
                <td>{{$turma->id}}</td>
                @foreach ($cursos as $curso)
                    @if($turma->curso == $curso->id)
                        <td>{{ $curso->nome }}</td>
                    @endif

                @endforeach

                @foreach ($modulos as $modulo)
                    @if($turma->modulo == $modulo->id)
                        <td>{{ $modulo->nome }}</td>
                    @endif
                @endforeach

                <td>{{ $turma->nome }}</td>

                <td class="text-end">
                    <div class="">
                        <a href="{{ route('turma.professor.show',['turma'=>$turma]) }}" class="btn btn-primary btn-sm btn-adicionar-aluno">professores</a>
                        <a href="{{ route('turma.aluno.show',['turma'=>$turma]) }}" class="btn btn-info btn-sm btn-adicionar-aluno">Alunos</a>
                        <a href="#" class="btn btn-outline-secondary btn-sm btn-editar" data-rota="{{ route('turma.update',['turma'=>$turma]) }}" data-nome="{{ $turma->nome }}" data-curso="{{ $turma->curso }}" data-modulo="{{ $turma->modulo }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="#" class="btn btn-outline-danger btn-sm btn-excluir" data-nome="{{ $turma->nome }}" data-rota="{{ route('turma.destroy',['turma'=>$turma]) }}">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </div>

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
            <h5 class="modal-title">Excluir turma</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-center">Confirma a exclusão da turma?</p>
            <h3 class="text-center" id="modalExcluirNome"></h3>
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
    <!-- Modal excluir - Fim -->

    <!-- Modal editar - Inicio -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar turma</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="needs-validation" action="" method="post" id="formEditar">
              <div class="modal-body">
                  @csrf
                  @method('put')
                  <div class="row g-3">
                      <div class="col-sm-12">
                          <label class="form-label">Nome da turma</label>
                          <input type="text" class="form-control" name="nome" id="editarNome"required>
                      </div>
                      <div class="col-sm-12">
                          <label class="form-label">*Curso</label>
                          <select class="form-select" id="editarCurso" name="curso_id">
                              <option value="0">Selecione</option>
                              @foreach ($cursos as $curso)
                                  <option value="{{$curso->id}}">{{$curso->nome}}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-sm-12">
                          <label class="form-label">*Modulo</label>
                          <select class="form-select" id="editarModulo" name="modulo_id">
                              <option value="0">Selecione...</option>
                              @foreach ($modulos as $modulo)
                                  <option value="{{$modulo->id}}">{{$modulo->nome}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn btn-primary" type="submit">Salvar</button>
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
    <!-- Modal adicionar aluno - Fim -->

    <script type="text/javascript">
    /* SCRIPTS - CADASTRO DE NOVA TURMA - INICIO */
    // Valida o campo nome
    $( "#nome" )
      .keyup(function() {
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
              addModulosNovo(value)
              $( "#modulo_id" ).prop( "disabled", false ).focus();
          } else {
              $(this).removeClass('is-valid')
              $( "#modulo_id" ).html('<option value"0">Selecione...</option>').prop( "disabled", true ).removeClass('is-valid');
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

      // Valida o campo modulo
      function addModulosNovo(curso){
          let url = "{{url('/getmodulo')}}/"+curso;
          $.get( url, function( data ) {
              $('#modulo_id').html(data);
          });
      }
      /* SCRIPTS - CADASTRO DE NOVA TURMA - FIM */

      //Excluir Registro
      $( ".btn-excluir" ).on( "click", function() {
          $('#formDelete').attr('action',$(this).data("rota"))
          $('#modalExcluirNome').html($(this).data('nome'))
          $('#modalExcluir').modal('show');
      });

      /* SCRIPTS - EDITAR TURMA - INICIO */
      //Editar Turma Capa
      $( ".btn-editar" ).on( "click", function() {
          $('#formEditar').attr('action',$(this).data("rota"))
          $('#editarNome').val($(this).data('nome'))
          $('#editarCurso').val($(this).data('curso'))
          $('#editarModulo').val($(this).data('modulo'))
          $('#modalEditar').modal('show');
      });



       $( "#editarNome" )
         .keyup(function() {
           if ($(this).val().length >= 5)
           {
               $(this).addClass('is-valid')

           } else {
               $(this).removeClass('is-valid')

           }
         })
         .keyup();


         // Valida o campo curso
         $('#editarCurso').change(function(e){
             let value = $('#editarCurso').val()
             if (value > 0) {
                 $(this).addClass('is-valid')
                 addModulosEditar(value)
                 $( "#editarModulo" ).prop( "disabled", false ).focus();
             } else {
                 $(this).removeClass('is-valid')
                 $( "#editarModulo" ).html('<option value"0">Selecione...</option>').prop( "disabled", true ).removeClass('is-valid');
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

         // Valida o campo modulo
         function addModulosEditar(curso){
             let url = "{{url('/getmodulo')}}/"+curso;
             $.get( url, function( data ) {
                 $('#editarModulo').html(data);
             });
         }
         /* SCRIPTS - EDITAR TURMA - FIM */

/* ------------------------------------------------ SCRIPTS - ADICIONAR ALUNOS A TURMA - FIM ------------------------------------------------*/
         //Adicionar aluno a turma
         $( ".btn-adicionar-aluno" ).on( "click", function() {
             // Busca o formulario de adicionar aluno e adicona a rota com o id da turma
             $('#formAddAluno').attr('action',$(this).data("rota"))
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
/* ------------------------------------------------ SCRIPTS - ADICIONAR ALUNOS A TURMA - FIM ------------------------------------------------*/

    </script>

</x-layout>
