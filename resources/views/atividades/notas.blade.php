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
       
        <table id="tableAlunosPoTurma" class="display table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th class="text-end">Nota</th>
    
            </tr>
        </thead>
        <tbody>
            @foreach ($alunos as $aluno)
                @foreach ($notas as $nota)                      
                    @if($nota->aluno_id == $aluno->id)
                    <tr>
                        <td>{{ $aluno->nome }}</td>
                        <td class="text-end">
                          
                        	   <input type="text" onblur="altera('{{$nota->id}}')" class="salva" id="{{$nota->id}}" name="{{$nota->id}}" size="3" value="{{$nota->nota}}">
                            
                          
                            
                        </td>      

                      </tr>
                        	
                    @endif
                @endforeach    
            @endforeach


            
       
        </tbody>
    </table>     



<script type="text/javascript">


function altera(id){


    let  nota = $('#'+id).val();
    window.location.href = "/alteraNota/"+id+"/"+nota;
    

}



</script>




</x-layout>