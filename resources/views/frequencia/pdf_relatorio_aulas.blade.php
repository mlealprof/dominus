<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Relatório de Aulas</title>
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
                   <h3> Relatório de Aulas Lançadas</h3>
                </td>
                
                <td width="200px">
                    <font size="1">
                        <b>Curso:</b> {{$cursos->nome}}<br>
                       <b>Turma:</b> {{$turmas->nome}} <br>                   
                       <b>Disciplina:</b> {{$disciplinas->nome}} <br>
                       <b>Carga Horária:</b>{{$disciplinas->carga_horaria}}h -
                        <b>Módulo:</b>{{$modulos->nome}}<br>
                       <b>Professor(a): </b> {{$professores->nome}}           
                       <br><b>Quantidade de Aulas:</b> {{$qtaulas}}
                   </font>
   
                 </td>
        </tr>
      
</table><br>
<font size="0.8em">

<table  id="taleta" border="0.5">
            <thead>
                <tr >
                    <th>Data</th>
                    <th>Conteúdo</th>                       
                </tr>
            </thead>
            <tbody>
                   
              @foreach ($aulas as $aula)
                <tr>
                  @if (( $aula->disciplina_id == $disciplina_id) and ($aula->turma_id == $turma_id))
                            
                            <td border="0" ><font size='0.8em'>{{ \Carbon\Carbon::parse($aula->data)->format('d/m/Y')}}</font></td>  
                            <td border="0" ><font size='0.8em'>{{ $aula->conteudo}} </font></td>
                           
                   @endif
                </tr>
             @endforeach                  
             
                                            
      
                
            </tbody> 
</table>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>