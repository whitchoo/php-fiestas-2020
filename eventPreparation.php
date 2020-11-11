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
					<h1>Bienvenido!</h1>
					<span class="image main"><img src="images/invited.jpg" alt="" /></span>
					<p>Enhorabuena! estas invitado al evento! para poder ayudarte en tu experiencia, te pediremos algunos datos para identificarte y algo más para preparar una sorpresa... gracias!</p>
					
					<section>
						<h2>Información solicitada</h2>
						<form method="POST" action="fiestaPrincipal.php">
							<div class="fields">
								<div class="field half">
									<input type="Hidden" name="idEvento" id="idEvento" value="<?=$_GET["idEvento"];?>">
									<input type="text" name="nombre" id="nombre" placeholder="Nombre... o como quieres que te identifiquen en el evento..." pattern="[a-zA-Z0-9 ]{3,}" title="Debe ingresar un nombre válido."/> 
									
									
									<br><br>
									<input type="text" name="palabra" id="palabra" placeholder="Una palabra que describa al agazajado..." pattern="[a-zA-Z]{3,}" title="Sólo una palabra! ;)"/> 
									
									
									<br><br>¿Quieres dejar un mensaje para el organizador? <br>
									(Saludos, felicitaciones, enhorabuenas, Kudos! ( ͡° ͜ʖ ͡°) &nbsp;&nbsp;) <br>
									(OPCIONAL... pero molaría que dediques unas palabras ;) ):
									<textarea name="kudos" id="kudos">
									
									</textarea>
									
								</div>
							</div>
							<ul class="actions">
								<li><input type="submit" value="Entrar al evento!" class="primary" /></li>
							</ul>
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