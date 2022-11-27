<x-layout title="Taleta de Fechamento">
   <h4>Módulo: 
           @foreach ($modulos as $modulo)
              @if ($modulo->id == $modulo_id)
                 {{$modulo->nome}}
              @endif
           @endforeach
           -  Curso: 
           @foreach ($cursos as $curso)
              @if ($curso->id == $curso_id)
                 {{$curso->nome}}
              @endif
           @endforeach

   </h4>

    <h5>Turma: 
           @foreach ($turmas as $turma)
              @if ($turma->id == $turma_id)
                 {{$turma->nome}}
              @endif
           @endforeach

   </h5>
    <h5>Disciplina: 
           @foreach ($disciplinas as $disciplina)
              @if ($disciplina->id == $disciplina_id)
                 {{$disciplina->nome}}
              @endif
           @endforeach

   </h5>
       <h5>Professor(a): 
           @foreach ($professores as $professore)
              @if ($professore->id == $professor_id)
                 {{$professore->nome}}
              @endif
           @endforeach

   </h5>



<table id="taleta" class="table table-bordered">
            <thead>
                <tr>
                    <th>N.º</th>
                    <th>Aluno</th> 
                    @foreach ($atividades as $atividade)
                       @if ( $atividade->disciplina_id == $disciplina_id)
                           
                            <th >{{$atividade->conteudo}} <br> Valor: {{$atividade->valor  }} </th>  
                            
                       @endif
                    @endforeach   
                           
                                                        
                    <th>Total</th>                                        
                </tr>
            </thead>
            <tbody>
                    
                
                    @foreach ($turmas_aluno as $aluno_turma)
                    <tr>  
                        @php
                           $soma=0;
                        @endphp
                        <td></td>
                         @if ($aluno_turma->turma_id == $turma_id)
                              @foreach ($alunos as $aluno)
                                  @if ($aluno->id == $aluno_turma->aluno_id)
                                    <td> {{$aluno->nome}}</td>
                                  @endif
                                             
                              @endforeach
                             @foreach ($atividades as $atividade)
                                   @if (($atividade->disciplina_id == $disciplina_id) and ($atividade->curso_id == $curso_id))
                                      @foreach ($notas as $nota)
                                          @if (($nota->atividade_id == $atividade->id) and ($nota->aluno_id == $aluno_turma->aluno_id))
                                                     @php
                                                       $soma+=$nota->nota;
                                                    @endphp
                                                    <td align="center"> {{$nota->nota}}</td>
                                          @endif
                                    @endforeach
                                   @endif

                             @endforeach 
                           <td align="center">{{$soma}}</td>

                         @endif
                    </tr>
                     @endforeach
                                            
      
                
            </tbody> 
</table>


</x-layout>