<x-layout title="Lançando Frequência">

	 
	 	<form class="needs-validation" action="{{$id}}/lancar" method="post">

	 	@csrf
	 	<div class="row g-3 border rounded-3 pb-3 user-select-none">
	 	 @foreach ($aulas as $aula)
            @if ($aula->id == $id)

	            <div class="col-sm-3">
	                <h3>Curso:</h3>
	                    @foreach ($cursos as $curso)
	                       @if ($curso->id == $aula->curso_id)
	                        <label class="form-label">{{$curso->nome}}</label>
	                       @endif
	                    @endforeach
	             </div>
	                <div class="col-sm-3">
	                <h3>Turma:</h3>
	                    @foreach ($turmas as $turma)
	                       @if ($turma->id == $aula->turma_id)
	                        <label class="form-label">{{$turma->nome}}</label>
	                       @endif
	                    @endforeach
	             </div>
	             <div class="col-sm-3">
	                <h3>Disciplina:</h3>
	                    @foreach ($disciplinas as $disciplina)
	                       @if ($disciplina->id == $aula->disciplina_id)
	                        <label class="form-label">{{$disciplina->nome}}</label>
	                       @endif
	                    @endforeach
	             </div>
	             <div class="col-sm-3">
	                <h3>Professor:</h3>
	                    @foreach ($professores as $professor)
	                       @if ($professor->id == $aula->professor_id)
	                        <label class="form-label">{{$professor->nome}}</label>
	                       @endif
	                    @endforeach
	             </div>
	             <div class="col-sm-9">
	                <h3>Conteúdo:</h3>
	                   <label class="form-label">{{$aula->conteudo}}</label>
	                    
	             </div>
	            @endif

           @endforeach
           <div class="col-3 align-self-end">   
               @if ($frequencias == '[]') 
	            <button class="btn btn-outline-primary btn-store" type="submit">Lançar Presença</button>	          
	           @endif
            </div>
        </div>

       </form>
       
        <table id="tableAlunosPoTurma" class="display table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th class="text-end">Presente?</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alunos as $aluno)
                @foreach ($frequencias as $frequencia)                      
                    @if($frequencia->aluno_id == $aluno->id)
                    <tr>
                        <td>{{ $aluno->nome }}</td>
                        <td class="text-end">
                        <form id="formPresenca">
                        	@csrf
                        	@if ($frequencia->presente==1)
	                        	<a href="{{$id}}/{{$frequencia->id}}/nao" class="btn btn-success btn-sm btn-sim" >
	                                SIM
	                            </a>
	                        @else
                                <a href="{{$id}}/{{$frequencia->id}}/sim" class="btn btn-danger btn-sm btn-nao" >
	                                NÃO
	                            </a>
	                        @endif
	                      </form>	


                            
                        </td>
                      </tr>
                    @endif
                @endforeach    
            @endforeach


            
       
        </tbody>
    </table>        

  <script type="text/javascript">


  </script>

</x-layout>