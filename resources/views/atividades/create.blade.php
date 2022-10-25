<x-layout title="Nova Atividade">

    <form class="needs-validation mb-3" action="{{route('atividade.store')}}" method="post">
        @csrf
        <div class="row g-3 border rounded-3 pb-3 user-select-none">
            <h5 class="text-primary">Criar nova Atividade</h5>
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
                                
                </select>
            </div>

            <div class="col-sm-7">
                <label class="form-label">*Professor</label>
                 <select class="form-select" id="professor_id" name="professor_id" >
                    <option value="0">Selecione...</option>
                                
                </select>
        
            </div>

            <div class="col-sm-4">
                <label class="form-label">*Data</label>
                <input type="date" class="form-control  "   name="data"  id="data">
            </div>

            <div class="col-sm-7">
                <label class="form-label">Conteúdo</label><br>
                <input type="text" class="form-control" name="conteudo" id="conteudo" >

            </div>
            <div class="col-sm-2">
                <label class="form-label">Valor Total</label><br>
                <input type="text" class="form-control" name="valor" id="valor" >

            </div>

             <br>


            <div class="col-sm-2 align-self-end text-end ">
                <button class="btn btn-outline-primary" type="submit" id="btnNovo" disabled>Cadastrar Atividade</button>
            </div>
        </div>
    </form>






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
              $("#data").focus();
              addProfessor($('#disciplina_id').val())
          } else {
              $(this).removeClass('is-valid')              
          }
      });




      //Validando Data
    //   $('#data').change(function(e){

    //          $(this).addClass('is-valid')             
   //           $("#conteudo").focus()
     
   //   });

      // Valida o campo Conteúdo
      $('#conteudo').change(function(e){
          let value = ($('#conteudo').val()).length
          if (value > 3) {
              $(this).addClass('is-valid')
              $("#valor").focus();
          } else {
              $(this).removeClass('is-valid')              
          }
      });

      // Valida o campo Valor Total
      $('#valor').change(function(e){
          let value = ($('#valor').val()).length
          if (value > 0) {
              $(this).addClass('is-valid')
              $( "#btnNovo" ).prop( "disabled", false ).focus();
          } else {
              $(this).removeClass('is-valid')              
          }
      });



      // Adiciona Disciplina de Acordo com a turma escolhido
      function addDisciplinaNovo(turma){ 

          let url = "{{url('/getdisciplina')}}/"+turma;          
          $.get( url, function(data) {
              $('#disciplina_id').html(data);
          });
      }







      // Adiciona Professor de Acordo com a disciplina escolhido
      function addProfessor(professor){         
           let url = "{{url('/getprofessor')}}/"+professor;
          $.get( url, function( data ) {
              $('#professor_id').html(data);
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
