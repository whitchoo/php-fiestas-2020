<!DOCTYPE HTML> 

<html>
	<head>
		<title>Eventos Online</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="CSSPhantom/assets/css/main.css" />
		<link rel="shortcut icon" href="/images/icon.ico" />
		<noscript><link rel="stylesheet" href="CSSPhantom/assets/css/noscript.css" /></noscript> 
	</head>
	
				
	<script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>


<script>
document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("Formulario").addEventListener('submit', validarFormulario); 
});

function validarFormulario(evento) {
  evento.preventDefault();
  var usuario = document.getElementById('nombre').value;
  if(usuario.length == 0) {
    alert('Es necesario que ingrese su nombre completo');
    return;
  }
  var email = document.getElementById('email').value;
  if (email.length == 0) {
    alert('Debe ingresar un correo electrónico válido.');
    return;
  }
  
  
  var password = document.getElementById('password').value;
  if(password.length == 0) {
    alert('Debe ingresar una contraseña.');
    return;
  }
  
  
  var reptpassword = document.getElementById('reptpassword').value;
  if(reptpassword.length == 0) {
    alert('Debe volver a escribir la contraseña.');
    return;
  }

  if(reptpassword != password) {
    alert('Los campos de contraseña no coinciden.');
    return;
  }
  
  
  
  
  this.submit();
}
</script>







			
	<body class="is-preload">
		<!-- Wrapper -->
		<div id="wrapper">

			<!-- Header -->
			<header id="header">
				<div class="inner">

					<!-- Logo 
						<a href="" class="logo">
							<span class="symbol"></span><span class="title">Eventos Online</span>
						</a>-->

					<!-- Nav -->
						<nav>
							<ul>
								<li><a href="#menu">Menu</a></li>
							</ul>
						</nav>

				</div>
			</header>

			<?php
			require 'menu.php';
			?>
				
				
				
				
				
				
				
				
			<!-- Main -->
			<div id="main">
				<div class="inner">
					<h1>Nuevo evento</h1>
					<section>
									<h2>Datos de organizador</h2>
									<form method="post" id="Formulario" action="eventNew2.php">
										<div class="row gtr-uniform">
											<div class="col-6 col-12-xsmall">
												<input type="text" name="nombre" id="nombre" value="" placeholder="* Nombre y apellidos" />
											</div>
											<div class="col-6 col-12-xsmall">
												<input type="email" name="email" id="email" value="" placeholder="* Email" />
											</div>
											
											<div class="col-6 col-12-xsmall">
												<input type="password" name="password" id="password" value="" placeholder="* Contraseña" />
											</div>
											<div class="col-6 col-12-xsmall">
												<input type="password" name="reptpassword" id="reptpassword" value="" placeholder="* Repetir Contraseña" />
											</div>
											
											
											
											<div class="col-12">
												<ul class="actions">
													<li><input type="submit" value="Solicitar" class="primary" /></li>
													<li><input type="reset" value="Reset" /></li>
												</ul>
											</div>
										</div>
									</form>
								</section>
				</div>
			</div>

				<!-- Footer -->
			<?php
			require 'footer.php';
			?>

		
		</div>

		<!-- Scripts -->
			<script src="CSSPhantom/assets/js/jquery.min.js"></script>
			<script src="CSSPhantom/assets/js/browser.min.js"></script>
			<script src="CSSPhantom/assets/js/breakpoints.min.js"></script>
			<script src="CSSPhantom/assets/js/util.js"></script>
			<script src="CSSPhantom/assets/js/main.js"></script>

	</body>
</html>