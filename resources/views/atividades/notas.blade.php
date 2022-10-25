<x-layout title="Lançando Notas">

	 
	 	<form class="needs-validation" action="{{$id}}/lancar" method="post">

	 	@csrf
	 	<div class="row g-3 border rounded-3 pb-3 user-select-none">
	 	 @foreach ($atividades as $atividade)
            @if ($atividade->id == $id)

	            <div class="col-sm-3">
	                <h3>Curso:</h3>
	                    @foreach ($cursos as $curso)
	                       @if ($curso->id == $atividade->curso_id)
	                        <label class="form-label">{{$curso->nome}}</label>
	                       @endif
	                    @endforeach
	             </div>
	                <div class="col-sm-3">
	                <h3>Turma:</h3>
	                    @foreach ($turmas as $turma)
	                       @if ($turma->id == $atividade->turma_id)
	                        <label class="form-label">{{$turma->nome}}</label>
	                       @endif
	                    @endforeach
	             </div>
	             <div class="col-sm-3">
	                <h3>Disciplina:</h3>
	                    @foreach ($disciplinas as $disciplina)
	                       @if ($disciplina->id == $atividade->disciplina_id)
	                        <label class="form-label">{{$disciplina->nome}}</label>
	                       @endif
	                    @endforeach
	             </div>

	             <div class="col-sm-6	">
	                <h3>Conteúdo:</h3>
	                   <label class="form-label">{{$atividade->conteudo}}</label>
	                    
	             </div>
	              <div class="col-sm-3">
	                <h3>Valor Total:</h3>
	                   <label class="form-label">{{$atividade->valor}}</label>
	                    
	             </div>
	            @endif

           @endforeach
           <div class="col-3 align-self-end">   
               @if ($notas == '[]') 
	            <button class="btn btn-outline-primary btn-store" type="submit">Lançar Notas</button>	          
	           @endif
            </div>
        </div>

       </form>
       
        <table id="tableAlunosPoTurma" class="displa table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th class="text-end">Nota</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alunos as $aluno)
                @foreach ($notas as $nota)                      
                    @if($nota->aluno_id == $aluno->id)
                    <tr>
                        <td>{{ $aluno->nome }}</td>
                        <td class="text-end">
                        	{{$nota->nota}}
                            
                        </td>
                        <td>
                        	<a href="#" class="btn btn-outline-secondary btn-sm btn-editar" data-rota="{{$nota->id}}/alterar" data-nota="{{$nota->nota}}" data-aluno="{{$aluno->nome}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </td>

                      </tr>
                        	
                    @endif
                @endforeach    
            @endforeach


            
       
        </tbody>
    </table>        


   <!-- Modal editar Notas - Inicio -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Nota </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="needs-validation" action="" method="get" id="formEditar">
              <div class="modal-body">
                  @csrf
                  @method('put')
                  <div class="row g-3">     
                  	  <div class="col-sm-12">
                      	<label class="form-label">Aluno:</label>
                      	<input type="text"  class="form-control" name="nome" id="editarAluno" value="" disabled>
                      </div>
                      <div class="col-sm-12">                      	
                          <label class="form-label">Nota:</label>
                          <input type="text" class="form-control" name="nota" id="editarNota"required>
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
    <!-- Modal editar Notas - Fim -->





  <script type="text/javascript">

      /* SCRIPTS - EDITAR NOTA - INICIO */
 
      $( ".btn-editar" ).on( "click", function() {
          $('#formEditar').attr('action',$(this).data("rota"))
          $('#editarAluno').val($(this).data('aluno')) 
          $('#editarNota').val($(this).data('nota'))                     
          $('#modalEditar').modal('show');
      });


  </script>

</x-layout>