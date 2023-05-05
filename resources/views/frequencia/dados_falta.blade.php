<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faltas Lançadas Turma/Disciplina</title>
</head>
<body>

<font size="0.8em">

<table  id="taleta" border="1">
            <thead>
                <tr >
                    <th>N.º</th>
                    <th>Aluno</th> 
                       @foreach ($aulas as $aula)
                       @if (( $aula->disciplina_id == $disciplina_id) and ($aula->turma_id == $turma_id))
                            
                            <th border="0" ><font size='0.5em'>{{ \Carbon\Carbon::parse($aula->data)->format('d/m/Y')}} </font></th>  
                           
                       @endif
                    @endforeach                  
                    <th>Total Faltas</th>                                        
                </tr>
            </thead>
            <tbody>
                   
                   @foreach ($alunos_turma as $aluno)
                       <tr >
                         @php
                           $qt=0;                                                                                    
                         @endphp
                         <td >{{$aluno->matricula}}</td>
                         <td > {{$aluno->nome}}</td> 

                         @foreach ($aulas as $aula)                                       
                              @php
                                  $achou = false;   
                              @endphp


                               @foreach ($frequencias as $frequencia)  
                                   @if (($frequencia->aluno_id == $aluno->aluno_id) and ($frequencia->id==$aula->id))
                                      <td class="text-end"> 
                                        <form id="formPresenca">
                                        @csrf
                                        @if ($frequencia->presente==1)
                                            <a href="lote/{{$frequencia->frequencia_id}}/nao" onclick="atualiza()" target="_blank" class="btn btn-success btn-sm btn-sim" id="{{$frequencia->frequencia_id}}" >
                                                SIM
                                            </a>
                                        @else
                                            <a href="lote/{{$frequencia->frequencia_id}}/sim" onclick="atualiza()" class="btn btn-danger btn-sm btn-nao"  target="_blank" id="{{$frequencia->frequencia_id}}" >
                                                NÃO
                                            </a>
                                            @php
                                             $qt=$qt+1;
                                            @endphp                                                      
                                       
                                        @endif
                                      </form>   


                                          
                                         @php
                                           $achou = true;
                                        @endphp
                                    @endif
                                </td>
                                @endforeach                          
                                @if ($achou==false)
                                   <td   heigh="0.5px"  align="center">-</td>
                                @endif
                         @endforeach
                            <td align="center">
                                @php
                                   echo $qt;
                                @endphp
                            </td>
                    
                        </tr>
                    @endforeach
                    
                  


                
                                            
      
                
            </tbody> 
</table>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>