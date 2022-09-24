<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/app.css" rel="stylesheet">
    <script src="../js/mascaras.js"></script>
    <title>Escola - Login</title>
</head>

<body class="text-center">
    <main class="form-signin col-4 m-auto mt-5">
        <form>
            <img class="mb-4" src="../icons/logo.png" width="250" height=""><br>
            <label class="mb-2">Insira os dados abaixo para acessar a plataforma</label>

            <div class="form-floating mb-2">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <a href="#">Recuperar senha</a>
                </label>
            </div>
            <a href="{{route('professores')}}" class="btn btn-primary btn-sm">Acessar</a>
            
        </form>
    </main>
</body>

</html>
