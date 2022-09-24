<x-layout title="Horarios">

    <form class="needs-validation" action="{{ route('horario.store') }}" method="post">
        @csrf
        <div class="row g-3">

            <div class="col-sm-5">
                <label class="form-label">*Aula</label>
                <input type="text" class="form-control" id="aula" name="aula" required>
                <div class="invalid-feedback">
                  O nome deve conter 5 caracteres ou mais.
                </div>
            </div>

            <div class="col-sm-2">
                <label class="form-label">*Hora inicio</label>
                <input type="time" class="form-control" id="horaInicio" name="horaInicio" required>
            </div>

            <div class="col-sm-2">
                <label class="form-label">*Hora Fim</label>
                <input type="time" class="form-control" id="horaFim" name="horaFim" required>
            </div>

            <div class="col-3 align-self-end">
                <button class="btn btn-outline-primary" type="submit" id="btnNovo">Cadastrar horario</button>
            </div>
        </div>
    </form>

    <br>

    <table class="display table" style="width:100%" id="tableModulos">
        <thead>
            <tr>
                <th>Aula</th>
                <th>Hora Inicio</th>
                <th>Hora Fim</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($horarios as $horario)
            <tr>
                <td>{{ $horario->aula }}</td>
                <td>{{ $horario->hora_inicio }}</td>
                <td>{{ $horario->hora_fim }}</td>
                <td class="text-end">
                    <a href="#" class="btn btn-outline-secondary btn-sm btn-editar"
                        data-aula="{{$horario->aula}}"
                        data-horaInicio="{{$horario->hora_inicio}}"
                        data-horaFim="{{$horario->hora_fim}}"
                        data-rota="{{ route('horario.update',['horario'=>$horario]) }}">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                    <a href="#" class="btn btn-outline-danger btn-sm btn-excluir"
                        data-nome="{{ $horario->aula }}"
                        data-rota="{{ route('horario.destroy',['horario'=>$horario]) }}">
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
            <h5 class="modal-title">Excluir horario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-center">Confirma a exclusão do horario?</p>
            <h3 class="text-center" id="excluirNome"></h3>
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
            <h5 class="modal-title">Editar horario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="needs-validation" action="" method="post" id="formEditar">
              <div class="modal-body">
                  @csrf
                  @method('put')
                  <div class="row g-3">
                      <div class="col-sm-12">
                          <label class="form-label">Aula</label>
                          <input type="text" class="form-control" name="aula" id="editarAula"required>
                      </div>
                      <div class="col-sm-12">
                          <label class="form-label">Hora inicio</label>
                          <input type="time" class="form-control" name="horaInicio" id="editarHoraInicio"required>
                      </div>
                      <div class="col-sm-12">
                          <label class="form-label">Hora fim</label>
                          <input type="time" class="form-control" name="horaFim" id="editarHoraFim"required>
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
            $('#formDelete').attr('action',$(this).data("rota"))
            $('#excluirNome').val($(this).data('nome'))
            modalName.textContent = $(this).data('nome')
            $('#modalExcluir').modal('show');
        });

        //Editar registro
        $( ".btn-editar" ).on( "click", function() {
            $('#editarAula').val($(this).data('aula'))
            $('#editarHoraInicio').val($(this).data('horainicio'))
            $('#editarHoraFim').val($(this).data('horafim'))

            console.log($(this).data())
            $('#formEditar').attr('action',$(this).data("rota"))
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
