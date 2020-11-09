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
					<h1>Eventos Online</h1>
					<span class="image main"><img src="images/confeti-wide.jpg" alt="" /></span>
					<H2>Bienvenido a tu evento online...</h2>
					

					<section>
						<h4>Si eres invitado, ingresa tu código a continuación:</h4>
						<form method="post" action="eventValidate.php">
							<div class="row gtr-uniform">
								<div class="col-6 col-12-xsmall" align="center">
									<input type="text" name="idEvento" id="idEvento" value="" placeholder="Aqui tu código! (ej. <SCMDDFESF>)" pattern="[a-zA-Z0-9]{9}" title="Revise el código que se le ha dado. No incluyas los espacios en blanco."/>
								</div>
								<div class="col-6 col-12-xsmall">
									<input type="submit" value="Entrar!" class="primary" />
								</div>
							

							</div>
						</form>
					</section>

					<br><br>
					<form  method="post" action="#"><br>
					<h4>Si quieres organizar tu evento online, este es tu sitio... </h4>
					<input type="submit" value="Crea tu nuevo evento!" class="primary" />
					</form>
					
					
					
					
					
					<section>
						<strong><br><br><br><br><p>Eres el organizador de un evento, entra aqui para administrar:</p></strong>
						<form method="post" action="#">
							<div class="row gtr-uniform">
								<div class="col-6 col-12-xsmall" align="center">
									<input type="text" name="demo-name" id="demo-name" value="" placeholder="Aqui tu código! (ej. <SCM DDF ESF>)" pattern="[a-z0-9]{11}" title="Revise el código que se le ha dado."/>
								</div>
								<div class="col-6 col-12-xsmall">
									<input type="password"  name="demo-name" id="demo-name" class="primary" />
								</div>
							</div>
							<div class="row gtr-uniform">

								<div class="col-6 col-12-xsmall">
									<input type="submit" value="administrar!" class="primary" />
								</div>
							

							</div>

						</form>
					</section>

					
					
					
					
				</div>
			</div>



			<?php
			require 'footer.php';
			?>


		</div>

				

			</div>

		<!-- Scripts -->
			<script src="CSSPhantom/assets/js/jquery.min.js"></script>
			<script src="CSSPhantom/assets/js/browser.min.js"></script>
			<script src="CSSPhantom/assets/js/breakpoints.min.js"></script>
			<script src="CSSPhantom/assets/js/util.js"></script>
			<script src="CSSPhantom/assets/js/main.js"></script>

	</body>
</html>