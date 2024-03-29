<x-layout title="Lançando Notas">


	    
        	
	 	<form class="needs-validation" action="{{$id}}/lancar" method="post">

	 	@csrf
	 	<div class="row g-3 border rounded-3 pb-3 user-select-none">
	 	 @foreach ($atividades as $atividade)
            @if ($atividade->id == $id)
			  @if ($atividade->recuperacao == '1')
			        	<h1><center> <font color='red'>ATIVIDADE DE RECUPERAÇÃO</font> </center></h1>
			        @endif	
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
	           @else
	           </form>

	            <form method="post" action="{{$id}}/atualizar">
	            	@csrf
	                <button class="btn btn-outline-primary btn-store" type="submit">Atualizar Lista</button>	          	          
	            </form>          
	           @endif
            </div>
        </div>







       </form>
       	<form method="post" action="{{$id}}/salvar">
	     @csrf	             
       
		        <table id="tableAlunosPoTurma" class="displa table table-striped" style="width:100%">
		        <thead>
		            <tr>
		                <th>Nome</th>
		                <th class="text-end">Nota</th>
		    
		            </tr>
		        </thead>
		        <tbody>
		            @foreach ($notas as $nota)                      
		                <tr>
		                    <td id="S">{{ $nota->aluno }}</td>
		                    <td class="text-end">
		                      <!--
		                      <input type="text" onblur="altera('{{$nota->id}}','{{$nota->atividade_id}}','{{$nota->nota}}')" id="{{$nota->id}}"  class="salva"  name="{{$nota->id}}" size="3" value="{{$nota->nota}}">
		                      -->
		                      <input type="text" name="{{$nota->id}}" id="{{$nota->id}}" size="3" class="salva" value="{{$nota->nota}}">
		                    </td>      
		                </tr>
		            @endforeach    
		        </tbody>
		    </table>  
		    <div style="position:absolut; float:right;">
           	  <button class="btn btn-outline-primary btn-store "   type="submit">Salvar</button>	
           	</div>          	          
	</form>    



<script type="text/javascript">


function altera(id,atividade,nota_anterior){


    let  nota = $('#'+id).val();   
    if(nota == nota_anterior)  {
       //
    }else{
    	window.location.href = "/alteraNota/"+id+"/"+nota+"/"+atividade;
    }
    
     

}



</script>




</x-layout>