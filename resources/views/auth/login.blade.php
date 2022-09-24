<!doctype html>
<html lang="en">
  <head>
  	<title>Dominus</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{ asset('css/login.css') }}">

	</head>
	<body class="img js-fullheight" style="background-image: url({{ asset('img/bg.jpg') }});">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
                        <div class="row justify-content-center pb-3">
		      	            <img class="mb-4 rounded" src="../icons/logo.png" width="250" height="">
                        </div>
        		      	<form action="{{ url('autenticate') }}" method="post" class="signin-form">
                            @csrf
        		      		<div class="form-group pb-3">
        		      			<input type="text" class="form-control" placeholder="Email" required name="email" value="dominus">
        		      		</div>
            	            <div class="form-group">
            	                   <input id="password-field" type="password" class="form-control" placeholder="Senha" required name="password" value="admin">
            	                   <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            	            </div>
            	            <div class="form-group pb-3 pt-3">
            	            	<button type="submit" class="form-control btn btn-primary submit px-3">Entrar</button>
            	            </div>
            	            <div class="form-group d-md-flex">
            	            	<div class="w-50">
            		            	<label class="checkbox-wrap checkbox-primary">Lembrar
                                        <input type="checkbox" checked>
            							<span class="checkmark"></span>
            						</label>
            					</div>
            					<div class="w-50 text-md-right">
            						<a href="#" style="color: #fff">Esqueci a senha</a>
            					</div>
            	            </div>
        	          </form>

		           </div>
				</div>
			</div>
		</div>
	</section>

    <script src="{{ asset('js/login/jquery.min.js') }}"></script>
    <script src="{{ asset('js/login/popper.js') }}"></script>
    <script src="{{ asset('js/login/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/login/main.js') }}"></script>

	</body>
</html>
