<!DOCTYPE HTML> 

<html>
	<head>
		<title>Eventos Online</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="CSSPhantom/assets/css/main.css" />
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
					<p>Enhorabuena! estas invitado al evento! para poder ayudarte en tu experiencia, te pediremos algunos datos para identificarte. gracias!</p>
					
					<section>
						<h2>Datos del invitado</h2>
						<form method="post" action="fiestaPrincipal.php">
							<div class="fields">
								<div class="field half">
									<input type="Hidden" name="evento" value="<?=$_GET["idEvento"];?>">
									<input type="text" name="nombre" id="nombre" placeholder="Nombre" pattern="[a-zA-Z0-9]{3,}" title="Debe ingresar un nombre válido."/>
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