<x-layout title="Aulas Lançadas">

    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight">
            <a href="/aulas/nova" class="btn btn-outline-primary">Nova Aula</a>
        </div>
    </div>


    <form class="needs-validation mb-3" action="{{route('aulas.store')}}" method="post">
        @csrf
        <div class="row g-3 border rounded-3 pb-3 user-select-none">
          
            <div class="col-sm-3">
                <label class="form-label">*Curso</label>
                <select class="form-select" id="curso_id" name="curso_id">
                    <option value="0">Selecione...</option>
                    @foreach ($cursos as $curso)
                        <option value="{{$curso->id}}">{{$curso->nome}}</option>
                    @endforeach
                </select>
            </div>


            <div class="col-sm-4">
                <label class="form-label">*Turma</label>
                <select class="form-select" id="turma_id" name="turma_id" disabled>
                    <option value="0">Selecione...</option>
                    @foreach ($turmas as $turma)
                        <option value="{{$turma->id}}">{{$turma->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-4">
                <label class="form-label">*Disciplina</label>
                <select class="form-select" id="disciplina_id" name="disciplina_id" disabled >
                    <option value="0">Selecione...</option>
                   @foreach ($disciplinas as $turma)
                        <option value="{{$turma->id}}">{{$turma->disciplina}}</option>
                    @endforeach
                    
                </select>
            </div>

            <div class="col-sm-3">
                <label class="form-label">Professor</label>
                <input type="text" class="form-control   " name="professor_id"  id='professor_id' disabled>
            </div>

            <div class="col-sm-3">
                <label class="form-label">Data Inicial</label>
                <input type="date" class="form-control  "   name="data" >
            </div>

            <div class="col-sm-3">
                <label class="form-label">Data Final</label>
                <input type="date" class="form-control  "   name="data" >
            </div>


            <div class="col-sm-2 align-self-end text-end ">
                <button class="btn btn-outline-primary" type="submit" id="btnNovo" disabled>Filtrar</button>
            </div>
        </div>
    </form>

<table id="tableAulas" class="display table table-striped" style="width:100%">
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
                    @foreach ($cursos as $curso)
                       @if($aula->curso_id == $curso->id)
                        <td>{{ $curso->nome }}</td>
                       @endif
                    @endforeach

                   
                    @foreach ($turmas as $turma)
                       @if($aula->turma_id ==$turma->id)
                        <td>{{ $turma->nome }}</td>
                       @endif
                    @endforeach

                    @foreach ($disciplinas as $disciplina)
                       @if($aula->disciplina_id == $disciplina->id)
                        <td>{{ $disciplina->nome }}</td>
                       @endif
                    @endforeach

                    
                     
          
                    <td>{{ \Carbon\Carbon::parse($aula->data)->format('d/m/Y')}}</td>
                   <td class="text-end">
                    <div class="">
                        <a href="" class="btn btn-primary btn-sm btn-adicionar-aluno">Frequência</a>                        
                        <a href="#" class="btn btn-outline-secondary btn-sm btn-editar"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="#" class="btn btn-outline-danger btn-sm btn-excluir"> 
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </div>

                </td>
                </tr>
                @endforeach
            </tbody>
        </table>






    <script type="text/javascript">
    /* SCRIPTS - CADASTRO DE NOVA TURMA - INICIO */

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
              addProfessor(value)
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


$('#turma_id').val()

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
