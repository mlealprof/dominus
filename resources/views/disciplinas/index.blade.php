<x-layout title="Disciplinas">

    <form class="needs-validation" action="{{ route('disciplina.store') }}" method="post">
        @csrf
        <div class="row g-3">

            <div class="col-sm-5">
                <label class="form-label">*Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
                <div class="invalid-feedback">
                  O nome deve conter 5 caracteres ou mais.
                </div>
            </div>

            <div class="col-sm-1">
                <label class="form-label">*Sigla</label>
                <input type="text" class="form-control" id="sigla" name="sigla" required disabled>
            </div>

            <div class="col-sm-3">
                <label class="form-label">*Carga Horaria</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="cargaHoraria" name="carga_horaria" required disabled>
                  <span class="input-group-text" id="basic-addon2">Horas</span>
                </div>

            </div>

            <div class="col-3 align-self-end">
                <button class="btn btn-outline-primary" type="submit" id="btnNovo" disabled>Cadastrar Disciplina</button>
            </div>
        </div>
    </form>

    <br>

    <table class="display table" style="width:100%" id="tableModulos">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Sigla</th>
                <th>Carga Horaria</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disciplinas as $disciplina)
            <tr>
                <td>{{ $disciplina->nome }}</td>
                <td>{{ $disciplina->sigla }}</td>
                <td>{{ $disciplina->carga_horaria }}</td>
                <td class="text-end">
                    <a href="#" class="btn btn-outline-secondary btn-sm btn-editar"
                        data-nome="{{$disciplina->nome}}"
                        data-sigla="{{$disciplina->sigla}}"
                        data-carga="{{$disciplina->carga_horaria}}"
                        data-rota="{{ route('disciplina.update',['disciplina'=>$disciplina]) }}">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="btn btn-outline-danger btn-sm btn-excluir"
                        data-nome="{{ $disciplina->nome }}"
                        data-rota="{{ route('disciplina.destroy',['disciplina'=>$disciplina]) }}">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal excluir - Inicio -->
    <div class="modal fade" id="modalExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Excluir disciplina</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-center">Confirma a exclusão da disciplina?</p>
            <h3 class="text-center"></h3>
            <p class="text-muted text-center">Não será possivel recuperar o registro.</p>
          </div>
          <div class="modal-footer">
            <form id="formDeleteUser" class="" action="" method="post">
                @csrf
                @method('delete')
                <button class="btn btn btn-danger" type="submit">Excluir</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal excluir - Fim -->

    <!-- Modal editar - Inicio -->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Disciplina</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="needs-validation" action="" method="post" id="formEditar">
              <div class="modal-body">
                  @csrf
                  @method('put')
                  <div class="row g-3">
                      <div class="col-sm-12">
                          <label class="form-label">Nome</label>
                          <input type="text" class="form-control" name="nome" id="editarNome"required>
                      </div>
                      <div class="col-sm-12">
                          <label class="form-label">Sigla</label>
                          <input type="text" class="form-control" name="sigla" id="editarSigla"required>
                      </div>
                      <div class="col-sm-12">
                          <label class="form-label">Carga Horaria</label>
                          <input type="number" class="form-control" name="carga_horaria" id="editarCargaHoraria"required>
                      </div>

                  </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn btn-primary" type="submit">Salvar</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal editar - Fim -->

    <script type="text/javascript">

        //Excluir Registro
        $( ".btn-excluir" ).on( "click", function() {
            let modal = document.getElementById('modalExcluir')
            let modalName = modal.querySelector('.modal-body h3')
            let form = document.getElementById('formDeleteUser')
            form.action = $(this).data('rota')
            modalName.textContent = $(this).data('nome')
            $('#modalExcluir').modal('show');
        });

        //Editar registro
        $( ".btn-editar" ).on( "click", function() {
            let form = document.getElementById('formEditar')

            $('#editarNome').val($(this).data('nome'))
            $('#editarSigla').val($(this).data('sigla'))
            $('#editarCargaHoraria').val($(this).data('carga'))

            form.action = $(this).data('rota')
            $('#modalEditar').modal('show');
        });

        // Valida o campo nome
        $( "#nome" )
          .keyup(function() {
            if ($(this).val().length >= 5)
            {
                $(this).addClass('is-valid')
                $( "#sigla" ).prop( "disabled", false)
            } else {
                $(this).removeClass('is-valid')
                $( "#sigla" ).prop( "disabled", true ).val('').removeClass('is-valid')
            }
          })
          .keyup();

          // Valida o campo sigla
          $( "#sigla" )
            .keyup(function() {
              if ($(this).val().length >= 2)
              {
                  $(this).addClass('is-valid')
                  $( "#cargaHoraria" ).prop( "disabled", false )
              } else {
                  $(this).removeClass('is-valid')
                  $( "#cargaHoraria" ).prop( "disabled", true ).val('')
              }
            })
            .keyup();

             //Valida o campo carga horaria
            $( "#cargaHoraria" )
              .keyup(function() {
                  if ($(this).val().length >= 1)
                  {
                      $(this).addClass('is-valid')
                      $( "#btnNovo" ).prop( "disabled", false )
                  } else {
                      $(this).removeClass('is-valid')
                      $( "#btnNovo" ).prop( "disabled", true )
                  }
              })
              .keyup();

              $('#cargaHoraria').on("change", function(){
                  if ($(this).val().length >= 1)
                  {
                      $(this).addClass('is-valid')
                      $( "#btnNovo" ).prop( "disabled", false )
                  } else {
                      $(this).removeClass('is-valid')
                      $( "#btnNovo" ).prop( "disabled", true )
                  }
              })



        </script>


</x-layout>
