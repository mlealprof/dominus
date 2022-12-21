<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Relatório de Frequencia</title>
</head>
<body>
<?php
   date_default_timezone_set ("America/Sao_Paulo");
   $hoje = date('d/m/Y  -  h:i:s');
   echo "<font size='0.4em'><div>Data: ".$hoje."<div></font>";
?>
      
      <table class="border" width="100%">
            <tr>
                <td width="180px">
                  
                      <h5>Dominus</h5>
                     <font size='1'>Av. Oton Barcelos, 653 <br>São Pedro, Arcos - MG, 35588-000</font>
                  
                </td>

                <td width="180px">
                   <h3> Relatório de Frequência</h3>
                </td>
                
                <td width="200px">
                    <font size="1">
                       <b>Turma:</b> 
                           @foreach ($turmas as $turma)
                              @if ($turma->id == $turma_id)
                                 {{$turma->nome}}
                              @endif
                           @endforeach
                    <br>
                   
                    <b>Disciplina:</b> 
                           @foreach ($disciplinas as $disciplina)
                              @if ($disciplina->id == $disciplina_id)
                                 {{$disciplina->nome}} <br>
                                 <b>Carga Horária:</b>{{$disciplina->carga_horaria}}h -
                                 <b>Módulo:</b>{{$modulos->nome}}
                              @endif
                           @endforeach

                   <br>
                       <b>Professor(a): </b>  
                           @foreach ($professores as $professore)
                              @if ($professore->id == $professor_id)
                                 {{$professore->nome}}
                              @endif
                           @endforeach
                           <br><b>Quantidade de Aulas:</b> {{$qtaulas}}
                   </font>
   
            </td>
        </tr>
      
</table><br>
<font size="0.4em">

<table  id="taleta" border="0.5">
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
                                       @if ($frequencia->presente == 1)
                                           <td align="center"> P </td>                            
                                       @else
                                          <td align="center"> F </td> 
                                          @php
                                             $qt=$qt+1;
                                          @endphp                                                      
                                       @endif
                                         @php
                                           $achou = true;
                                        @endphp
                                    @endif
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