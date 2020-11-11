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
	<?php
	
		$nombre = $_POST["nombre"];
		$email = $_POST["email"];
		$password = $_POST["password"];
	
	?>
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
									<h2>Datos del evento</h2>
									<form method="post" action="#">
									
										<input type="hidden" name="nombre" value="<?=$nombre?>">
										<input type="hidden" name="email" value="<?=$email?>">
										<input type="hidden" name="password" value="<?=$password?>">

										<div class="row gtr-uniform">
											<div class="col-6 col-12-xsmall">
												Fecha del evento.<br>
												<input type="date" name="fecha" id="fecha" value="2020-11-10">
											</div>
											<div class="col-6 col-12-xsmall">
											</div>
											
											<div class="col-6 col-12-xsmall">
												Hora de comienzo del evento.<br>
												<input type="time" name="HoraInicio" id="HoraInicio" value="09:00">
											</div>
											
											<div class="col-6 col-12-xsmall">
												Hora de fin del evento.<br>
												<input type="time" name="HoraFin" id="HoraFin" value="12:30">
											</div>
											<div class="col-6 col-12-xsmall">
												<input type="text" name="pPrecio" id="pPrecio" value="23 EUR" editable=false>
											<div class="col-6 col-12-xsmall">
											<?php
												$preciohora = 10;
											?>
											<script>
												
												var dateIn = document.getElementById("HoraInicio").value;
												var dateFin = document.getElementById("HoraFin").value;
												
												  inicioMinutos = parseInt(dateIn.substr(3,2));
												  inicioHoras = parseInt(dateIn.substr(0,2));
												  
												  finMinutos = parseInt(dateFin.substr(3,2));
												  finHoras = parseInt(dateFin.substr(0,2));

												  transcurridoMinutos = finMinutos - inicioMinutos;
												  transcurridoHoras = finHoras - inicioHoras;
												  
												  if (transcurridoMinutos < 0) {
													transcurridoHoras--;
													transcurridoMinutos = 60 + transcurridoMinutos;
												  }
												  
												  horas = transcurridoHoras.toString();
												  minutos = transcurridoMinutos.toString();
												  
												  if (horas.length < 2) {
													horas = "0"+horas;
												  }
												  
												  if (horas.length < 2) {
													horas = "0"+horas;
												  }

												  cantidadHoras = parseInt(horas)+(parseInt(minutos)/60);
												
												var p = document.getElementById("pPrecio");
												p.value=<?=$preciohora;?>*cantidadHoras;
											</script>
											
											
											
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