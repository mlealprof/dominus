<x-layout title="Aulas Lançadas">

    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight">
            <a href="/aulas/nova" class="btn btn-outline-primary">Nova Aula</a>
        </div>
    </div>
<hr>
<form method="post" action="{{ route('aulas.filtro') }}">
  @csrf
  <div class="row g-3 border rounded-3 pb-3 user-select-none"> 
    <div class="col-sm-3">
      <select  class="form-select" id="curso_id" name="curso_id" >
        <option value="0">Curso</option>
        @foreach ($cursos as $curso)    
            <option value="{{$curso->curso_id}}">{{$curso->curso}}</option>
        @endforeach
      </select>
    </div>  

      <div class="col-sm-3">
      <select class="form-select" id="turma_id" name="turma_id" >
            <option value="0">Turma</option>
            @foreach ($turmas as $turma)    
                <option value="{{$turma->turma_id}}">{{$turma->turma}}</option>
            @endforeach
                      
      </select>
    </div>   

    <div class="col-sm-3">
      <select class="form-select" id="disciplina_id" name="disciplina_id" >
          <option value="0">Disciplina</option>
          @foreach ($disciplinas as $disciplina)    
              <option value="{{$disciplina->disciplina_id}}">{{$disciplina->disciplina}}</option>
          @endforeach
      </select>
    </div>
    <div class="col-sm-2">
      <button class="float-right" type="submit">Filtrar</button>
    </div>
  </div>


</form>
<hr>


<table id="tableAulas" class="displa table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Turma</th>
                    <th>Disciplina</th>
                    <th>Data Aula</th>                    
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aulas as $aula)
                <tr>
          
                     <td>{{ $aula->curso }}</td>
                     <td>{{ $aula->turma }}</td>
                     <td>{{ $aula->disciplina }}</td>
                     <td>{{ \Carbon\Carbon::parse($aula->data)->format('d/m/Y')}}</td>
                   <td class="text-end">
                    <div class="">
                        <a href="/aulas/frequencia/{{$aula->id}}" class="btn btn-primary btn-sm btn-adicionar-aluno">Frequência</a>  
                        <a href="/aulas/frequencia/copiar/{{$aula->id}}" class="btn btn-primary btn-sm btn-adicionar-aluno">Copiar</a> 
                        
                        
                            <a href="#" class="btn btn-outline-secondary btn-sm btn-editar" data-curso="{{ $aula->curso }}" data-turma="{{ $aula->turma }}"  data-disciplina="{{ $aula->disciplina }}" data-professor="{{ $aula->professor}}" data-data="{{ $aula->data }}" data-conteudo="{{ $aula->conteudo }}" data-rota="{{ route('aulas.update',[$aula->id]) }}"> 
                            <i class="fa fa-pencil" aria-hidden="true">Editar</i>
                           </a>


                            <a href="#" class="btn btn-outline-danger btn-sm btn-excluir"data-aula="{{ $aula->id }}" data-rota="{{ route('aulas.destroy',[$aula->id]) }}">
                                <i class="fa fa-trash" aria-hidden="true">Excluir </i>
                            </a>
                        

                    </div>

                </td>
                </tr>
                @endforeach
            </tbody>
        </table>



   <!-- Modal editar Aula - Inicio -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Aula </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="needs-validation" action="" method="post" id="formEditar">
              <div class="modal-body">
                  @csrf
                  @method('put')
                  <div class="row g-3">
                      
                      <div class="col-sm-12">
                          <label class="form-label">*Data</label>
                          <input type="date" class="form-control" name="data" id="editarData"required>
                      </div>
                      <div class="col-sm-12">
                          <label class="form-label">*Conteúdo</label>
                          <input type="text" class="form-control" name="conteudo" id="editarConteudo"required>
                      </div>

                  </div>
              </div>
              
              <div class="modal-footer">
                <button class="btn btn btn-primary" type="submit">Salvar</button>
              </div>
              </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal editar Aula - Fim -->



 <!-- Modal excluir - Inicio -->
    <div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Excluir Aula</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-center">Confirma a exclusão da Aula?</p>
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




    <script type="text/javascript">
    /* SCRIPTS - CADASTRO DE NOVA AULA - INICIO */

      // Valida o campo curso
      $('#curso_id').change(function(e){
          let value = $('#curso_id').val()
          if (value > 0) {
              $(this).addClass('is-valid')
              addTurmaNovo(value)
              $( "#turma_id" ).prop( "disabled", false ).focus();
          } else {
              $(this).removeClass('is-valid')
              $( "#turma_id" ).html('<option value"0">Selecione...</option>').prop( "disabled", true ).removeClass('is-valid');
          }
      });

      // Valida o campo turma
      $('#turma_id').change(function(e){
          let value = $('#turma_id').val()
          if (value > 0) {
             $(this).addClass('is-valid')
              addDisciplinaNovo(value)
              $( "#disciplina_id" ).prop( "disabled", false ).focus();          
          } else {
              $(this).removeClass('is-valid')
              $( "#disciplina_id" ).html('<option value"0">Selecione...</option>').prop( "disabled",  true ).removeClass('is-valid');
          }
      });

      // Adiciona turma de Acordo com o curso escolhido
      function addTurmaNovo(turma){
          let url = "{{url('/getturma')}}/"+turma;
          $.get( url, function( data ) {
              $('#turma_id').html(data);
          });
      }






      // Valida o campo Disciplina
      $('#disciplina_id').change(function(e){
          let value = $('#turma_id').val()
          if (value > 0) {
              $(this).addClass('is-valid')              
              $( "#btnNovo" ).prop( "disabled", false ).focus();
              addProfessor($('#disciplina_id').val())
          } else {
              $(this).removeClass('is-valid')
              $( "#btnNovo" ).val('').prop( "disabled", true );
          }
      });

      // Adiciona Disciplina de Acordo com a turma escolhido
      function addDisciplinaNovo(turma){
          let url = "{{url('/getdisciplina')}}/"+turma;
          $.get( url, function( data ) {
              $('#disciplina_id').html(data);
          });
      }







      // Adiciona Professor de Acordo com a disciplina escolhido
      function addProfessor(professor){         
           let url = "{{url('/getprofessor')}}/"+professor;
          $.get( url, function( data ) {
              $('#professor_id').val(data);
          });          
                       
      }


$('#aula_id').val()

      /* SCRIPTS - CADASTRO DE NOVA AULA - FIM */








      /* SCRIPTS - EDITAR AULA - INICIO */
      //Editar Turma Capa
      $( ".btn-editar" ).on( "click", function() {
          $('#formEditar').attr('action',$(this).data("rota"))
          $('#editarCurso').val($(this).data('curso'))
          $('#editarDisciplina').val($(this).data('disciplina'))
          $('#editarTurma').val($(this).data('turma'))
          $('#editarProfessor').val($(this).data('professor'))
          $('#editarData').val($(this).data('data'))
          $('#editarConteudo').val($(this).data('conteudo'))                   
          $('#modalEditar').modal('show');
      });



      //Excluir Registro
      $( ".btn-excluir" ).on( "click", function() {
          $('#formDelete').attr('action',$(this).data("rota"))
          $('#modalExcluirNome').html($(this).data('nome'))
          $('#modalExcluir').modal('show');
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
