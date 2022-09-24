<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/mascaras.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Dominus</title>
</head>

<body>
    <header class="navbar navbar-light  bg-light shadow">
        <div class="container-fluid">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/home">
                <img src="{{ asset('icons/logo.png') }}" alt="Home" class="rounded">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Cadastros
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Professor</a></li>
                    <li><a class="dropdown-item" href="#">Aluno</a></li>
                    <li><a class="dropdown-item" href="#">Turma</a></li>
                    <li><a class="dropdown-item" href="#">Disciplina</a></li>
                    <li><a class="dropdown-item" href="#">Cursos</a></li>
                    <li><a class="dropdown-item" href="#">Modulos</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/') }}">Sair</a>
                </li>
              </ul>
            </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <x-sidebar />
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 bg-light">
                <div class="col col-lg-11 mt-5">
                    <h1 class="text-primary mb-3">{{ $title }}</h1>
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
    //DataTable
    $(document).ready(function () {
        $('table.display').DataTable({
            paging: true,   //Exibir paginação
            ordering: true, // Permite ordenar
            info: false, // exibe informação no footer
            lengthChange: false, // exibe o botão a quantidade de registros por pagina
            stateSave: true,
            order: [[0, 'asc']], // ordenar (desc ou asc)
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json',
            },
        });
    });
    </script>
</body>

</html>
