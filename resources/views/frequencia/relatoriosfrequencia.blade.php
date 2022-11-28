<x-layout title="Relatórios de Frequência	">
<form class="needs-validation mb-3" action="{{route('frequencia.relatorio')}}" method="post">
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
                <label class="form-label">*Módulo</label>
                <select class="form-select" id="modulo_id" name="modulo_id" disabled>
                    <option value="0">Selecione...</option>
                    @foreach ($modulos as $modulo)
                        <option value="{{$modulo->id}}">{{$modulo->nome}}</option>
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

            <div class="col-sm-5">
                <label class="form-label">*Professor</label>
                 <select class="form-select" id="professor_id" name="professor_id" >
                    <option value="0">Selecione...</option>
                                
                </select>
        
            </div>


            <div class="col-sm-2 align-self-end text-end ">
                <button class="btn btn-outline-primary" type="submit" id="btnNovo" disabled>Gerar Taleta</button>
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
              addModulo(value)
              $( "#modulo_id" ).prop( "disabled", false ).focus();
          } else {
              $(this).removeClass('is-valid')
              $( "#modulo_id" ).html('<option value"0">Selecione...</option>').prop( "disabled", true ).removeClass('is-valid');
          }
      });


      // Valida o campo Modulo
      $('#modulo_id').change(function(e){
          let value = $('#modulo_id').val()
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
      function addModulo(curso){
          let url = "{{url('/getmodulo')}}/"+curso;
          $.get( url, function( data ) {
              $('#modulo_id').html(data);
          });
      }

      // Adiciona turma de Acordo com o curso escolhido
      function addTurmaNovo(turma){
          let url = "{{url('/getturmamodulo')}}/"+turma;
          $.get( url, function( data ) {
              $('#turma_id').html(data);
          });
      }

      // Valida o campo Disciplina
      $('#disciplina_id').change(function(e){
          let value = $('#turma_id').val()
          if (value > 0) {
              $(this).addClass('is-valid');
               $( "#btnNovo" ).prop( "disabled", false ).focus();
              $("#btnNovo").focus();
              addProfessor($('#disciplina_id').val())
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
</script>

</x-layout>