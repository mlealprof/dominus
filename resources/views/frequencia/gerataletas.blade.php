<x-layout title="Taleta de Frequência">
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
                 {{$disciplina->nome}}  - Carga Horária:{{$disciplina->carga_horaria}}h
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
                       @foreach ($aulas as $aula)
                       @if (( $aula->disciplina_id == $disciplina_id) and ($aula->turma_id == $turma_id))
                           
                            <th >{{ \Carbon\Carbon::parse($aula->data)->format('d/m/Y')}} </th>  
                            
                       @endif
                    @endforeach                  
                    <th>Total Faltas</th>                                        
                </tr>
            </thead>
            <tbody>
                    
                @foreach ($turmas_aluno as $aluno_turma)
                    <tr>
                    @if ($aluno_turma->turma_id == $turma_id)
                        @foreach ($alunos as $aluno)
                             @if ($aluno->id == $aluno_turma->aluno_id)
                                  <td></td>
                                  <td> {{$aluno->nome}}</td>
                                  @php
                                     $faltas=0;
                                  @endphp
                                  @foreach ($aulas as $aula)
                                     @if (( $aula->disciplina_id == $disciplina_id) and ($aula->turma_id == $turma_id))
                                        @foreach ($frequencias as $frequencia)                                        
                                            @if (($frequencia->aulas_id == $aula->id)and($frequencia->aluno_id==$aluno_turma->aluno_id))
                                               @if ($frequencia->presente == 1)
                                                 <td align="center"> P </td>
                                               @else
                                                <td align="center"> F </td>
                                                @php
                                                   $faltas=$faltas + 1;
                                                @endphp
                                               @endif

                                            @endif
                                        @endforeach 
                                     @endif
                                  @endforeach
                                  <td align="center">{{$faltas}}</td>
                             @endif                                                                  
                        @endforeach
                    @endif
                    
                    </tr>
                @endforeach
                                            
      
                
            </tbody> 
</table>


</x-layout>


