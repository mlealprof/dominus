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
                        <a href="#" class="btn btn-outline-secondary btn-sm btn-editar" data-curso="{{ $atividade->curso_id }}" data-turma="{{ $atividade->turma_id }}"  data-disciplina="{{ $atividade->disciplina_id }}"  data-data="{{ $atividade->data }}" data-conteudo="{{ $atividade->conteudo }}"  data-valor="{{ $atividade->valor }}" data-rota="atividades/alterar/{{$atividade->id}}">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                        <a href="#" class="btn btn-outline-danger btn-sm btn-excluir" data-rota="atividades/excluir/{{$atividade->id}}"> 
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </div>

                </td>
                </tr>
                @endforeach
            </tbody>
        </table>


 <!-- Modal editar Aula - Inicio -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Atividade </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="needs-validation" action="" method="post" id="formEditar">
              <div class="modal-body">
                  @csrf
                  @method('put')
                  <div class="row g-3">
                      <div class="col-sm-12">
                          <label class="form-label">*Curso</label>
                          <select class="form-select" id="editarCurso" name="curso_id" value="teste">
                              <option value="0">Selecione</option>
                              @foreach ($cursos as $curso)
                                  <option value="{{$curso->id}}">{{$curso->nome}}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="col-sm-12">
                          <label class="form-label">*Turma</label>
                          <select class="form-select" id="editarTurma" name="turma_id">
                              <option value="0">Selecione</option>
                              @foreach ($turmas as $turma)
                                  <option value="{{$turma->id}}">{{$turma->nome}}</option>
                              @endforeach
                          </select>
                     </div>
                      <div class="col-sm-12">
                      <label class="form-label">*Disciplina</label>
                      <select class="form-select" id="editarDisciplina" name="disciplina_id">
                          <option value="0">Selecione</option>
                          @foreach ($disciplinas as $disciplina)
                              <option value="{{$disciplina->id}}">{{$disciplina->nome}}</option>
                          @endforeach
                      </select>
                     </div>
                      <div class="col-sm-12">
                          <label class="form-label">*Data</label>
                          <input type="date" class="form-control" name="data" id="editarData"required>
                      </div>
                      <div class="col-sm-12">
                          <label class="form-label">*Conteúdo</label>
                          <input type="text" class="form-control" name="conteudo" id="editarConteudo"required>
                      </div>

                      <div class="col-sm-12">
                          <label class="form-label">*Valor</label>
                          <input type="text" class="form-control" name="valor" id="editarValor"required>
                      </div>

                  </div>
              </div>
              
              <div class="modal-footer">
                <button class="btn btn btn-primary" type="submit">Salvar</button>
              </div>
              </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal editar Aula - Fim -->

 <!-- Modal excluir - Inicio -->
    <div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Excluir Aula</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-center">Confirma a exclusão da Atividade?</p>
            <h3 class="text-center" id="modalExcluirNome"></h3>
            <p class="text-muted text-center">Não será possivel recuperar o registro.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <form id="formDelete" class="" action="" method="post">
                @csrf
                @method('delete')
                <button class="btn btn btn-danger" type="submit">Excluir</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal excluir - Fim -->


<script type="text/javascript">
    
      /* SCRIPTS - EDITAR Atividade - INICIO */
      //Editar Turma Capa
      $( ".btn-editar" ).on( "click", function() {
          $('#formEditar').attr('action',$(this).data("rota"))
          $('#editarCurso').val($(this).data('curso'))
          $('#editarDisciplina').val($(this).data('disciplina'))
          $('#editarTurma').val($(this).data('turma'))
          $('#editarData').val($(this).data('data'))
          $('#editarConteudo').val($(this).data('conteudo'))   
          $('#editarValor').val($(this).data('valor'))                  
          $('#modalEditar').modal('show');
      });



      //Excluir Registro
      $( ".btn-excluir" ).on( "click", function() {
          $('#formDelete').attr('action',$(this).data("rota"))
          $('#modalExcluirNome').html($(this).data('nome'))
          $('#modalExcluir').modal('show');
      });

</script>




</x-layout>
