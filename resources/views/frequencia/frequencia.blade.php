<x-layout title="Lançando Frequência">

	 
	 	<form class="needs-validation" action="{{$id}}/lancar" method="post">

	 	@csrf
	 	<div class="row g-3 border rounded-3 pb-3 user-select-none">
	            <div class="col-sm-3">
	                <h3>Curso:</h3>
	                     <label class="form-label">{{$cursos->nome}}</label>	                      
	             </div>
	                <div class="col-sm-3">
	                <h3>Turma:</h3>
	                    <label class="form-label">{{$turmas->nome}}</label>	                    
	             </div>
	             <div class="col-sm-3">
	                <h3>Disciplina:</h3>
	                     <label class="form-label">{{$disciplinas->nome}}</label>
	             </div>
	             <div class="col-sm-3">
	                <h3>Professor:</h3>
	                        <label class="form-label">{{$professores->nome}}</label>
	             </div>
	             <div class="col-sm-9">
	                <h3>Conteúdo:</h3>
	                   <label class="form-label">{{$aulas->conteudo}}</label>	                    
	             </div>
	             <div class="col-sm-3">
	                <h3>Data:</h3>
	                   <label class="form-label">{{ \Carbon\Carbon::parse($aulas->data)->format('d/m/Y')}}</label>	                    
	             </div>
             <div class="col-3 align-self-end">   
               @if ($frequencias == '[]') 
	            <button class="btn btn-outline-primary btn-store" type="submit">Lançar Presença</button>	          
	           @endif
            </div>
        </div>

       </form>
       
        <table id="tableAlunosPoTurma" class="displa table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th class="text-end">Presente?</th>
            </tr>
        </thead>
        <tbody>
                @foreach ($frequencias as $frequencia)  
                    <tr>
                        <td>{{ $frequencia->nome }}</td>
                        <td class="text-end">
                        <form id="formPresenca">
                        	@csrf
                        	@if ($frequencia->presente==1)
	                        	<a href="{{$id}}/{{$frequencia->id}}/nao" class="btn btn-success btn-sm btn-sim" id="{{$frequencia->id}}" >
	                                SIM
	                            </a>
	                        @else
                                <a href="{{$id}}/{{$frequencia->id}}/sim" class="btn btn-danger btn-sm btn-nao" id="{{$frequencia->id}}" >
	                                NÃO
	                            </a>
	                        @endif
	                      </form>	


                            
                        </td>
                      </tr>
                
                @endforeach    
  

            
       
        </tbody>
    </table>        

  <script type="text/javascript">


  </script>

</x-layout>