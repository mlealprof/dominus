<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Relatório de Nota por Turma</title>
</head>
<body>
<?php
   date_default_timezone_set ("America/Sao_Paulo");
   $hoje = date('d/m/Y  -  h:i:s');
   echo "<font size='0.4em'><div>Data: ".$hoje."<div></font>";
   $fonte = $_POST['fonte'];
   if ($fonte == '0') {
       $tamanho ='8';
   }
   if ($fonte == '1') {
       $tamanho ='6';
   }
   if ($fonte == '2') {
       $tamanho ='4';
   }
?>
      
      <table class="border" width="100%">
            <tr>
                <td width="180px">
                  
                      <h5>Dominus</h5>
                     <font size='1'>Av. Oton Barcelos, 653 <br>São Pedro, Arcos - MG, 35588-000</font>
                  
                </td>

                <td width="220px">
                   <h3> Relatório de Nota por Turma</h3>
                </td>
                
                 <td width="200px">
                    <font size="1">
                       <b>Curso:</b> {{$cursos->nome}}<br>
                       <b>Turma:</b> {{$turmas->nome}} <br>                   
                       <b>Disciplina:</b> {{$disciplinas->nome}} <br>
                       <b>Carga Horária:</b>{{$disciplinas->carga_horaria}}h -
                        <b>Módulo:</b>{{$modulos->nome}}<br>
                       <b>Professor(a): </b> {{$professores->nome}}    <br>       
                       <b>Total Atividades:</b> {{$total_notas}} Pontos
                     
                   </font>
   
                 </td>
        
           </tr>
      
</table><br>
<font <?php echo "size='0.".$tamanho."em'";?> >

<table id="taleta" border="'">
            <thead>
                <tr>
                    <th>N.º</th>
                    <th>Aluno</th> 
                    @foreach ($atividades as $atividade)                           
                            <th style="white-space: pre-wrap;" width="80px"><center>{{ \Carbon\Carbon::parse($atividade->data)->format('d/m/Y')}} <br><font size="0.7em">{{$atividade->conteudo}}</font> <br> Valor: {{$atividade->valor  }} </th>  
                    @endforeach                         
                    <th>Total</th>                                        
                </tr>
            </thead>
            <tbody>
                    
                
                    @foreach ($turmas_aluno as $aluno_turma)
                        <tr>  
                            @php
                               $soma=0;  
                               $recuperacao=0;                         
                            @endphp                       
                            <td>{{$aluno_turma->matricula}}</td>
                            <td> {{$aluno_turma->nome}}</td>
                            
                            @foreach ($atividades as $atividade)
                            @php
                              $achou=false;        
                              $recuperacao=0;
                            @endphp
                               @foreach ($notas as $nota)
                                    @if (($nota->aluno_id == $aluno_turma->aluno_id) and ($nota->atividade_id == $atividade->id))
                                       @if ($atividade->recuperacao == '0')
                                            @php
                                                $soma+=$nota->nota;                                                
                                            @endphp  
                                        @else
                                           @if ($nota->nota != 0)  
                                              @php              
                                                 $recuperacao=$nota->nota;                                                 
                                              @endphp
                                           @endif

                                        @endif
                                        @php                                                
                                          $achou = true;
                                        @endphp                                       

                                        <td align="center"> {{$nota->nota}}</td>
                                    @endif
                                @endforeach 
                                @if ($achou == false)
                                <td align="center">-</td>
                            @endif                           
                            @endforeach                           
                            @if ($recuperacao == 0)
                               <td align="center">{{$soma}}</td>
                            @else
                               <td align="center">{{$recuperacao}}</td>
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