<x-layout title="Atividades Lançadas">

    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight">
            <a href="/atividades/nova" class="btn btn-outline-primary">Nova Atividade</a>
        </div>
    </div>

<table id="tableAulas" class="display table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Turma</th>
                    <th>Disciplina</th>
                    <th>Data Atividade</th>                                      
                    <th>Valor Atividade</th>                    
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($atividades as $atividade)
                <tr>
                    @foreach ($cursos as $curso)
                       @if($atividade->curso_id == $curso->id)
                        <td>{{ $curso->nome }}</td>
                       @endif
                    @endforeach

                   
                    @foreach ($turmas as $turma)
                       @if($atividade->turma_id ==$turma->id)
                        <td>{{ $turma->nome }}</td>
                       @endif
                    @endforeach

                    @foreach ($disciplinas as $disciplina)
                       @if($atividade->disciplina_id == $disciplina->id)
                        <td>{{ $disciplina->nome }}</td>
                       @endif
                    @endforeach

                    
                     
          
                    <td>{{ \Carbon\Carbon::parse($atividade->data)->format('d/m/Y')}}</td>


                    <td>{{$atividade->valor}}</td>

                   <td class="text-end">
                    <div class="">
                        <a href="atividades/notas/{{$atividade->id}}" class="btn btn-primary btn-sm btn-adicionar-aluno">Notas</a>                        
                        <a href="#" class="btn btn-outline-secondary btn-sm btn-editar" data-curso=""  data-rota="">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                        <a href="#" class="btn btn-outline-danger btn-sm btn-excluir"data-aula="" data-rota=""> 
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </div>

                </td>
                </tr>
                @endforeach
            </tbody>
        </table>


</x-layout>
