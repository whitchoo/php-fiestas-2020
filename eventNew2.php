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
	  document.getElementById("HoraInicio").addEventListener('change', calcularHoras); 
	});
	document.addEventListener("DOMContentLoaded", function() {
	  document.getElementById("HoraFin").addEventListener('change', calcularHoras); 
	});
	document.addEventListener("DOMContentLoaded", function() {
	  document.getElementById("pCantHoras").addEventListener('change', calcularPrecio); 
	});


	document.addEventListener("DOMContentLoaded", function() {
	  document.getElementById("Formulario").addEventListener('submit', validarFormulario); 
	});

	function validarFormulario(evento) {
		evento.preventDefault();
		var selected = new Date(document.getElementById("fecha").value + " " +document.getElementById("HoraInicio").Value);
		var Today = new Date(Date.now());
		if(Today.diff(selected, 'hours')< 0){
			alert('La fecha y hora seleccionada no puede ser anterior al día de hoy.');
			return;
		}

		this.submit();
	}
	
	
	
	function calcularHoras() {
		var objdateIn = document.getElementById("HoraInicio");
		var objdateFin = document.getElementById("HoraFin");
		var dateIn = objdateIn.value;
		var dateFin = objdateFin.value;
		
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
		
		if(cantidadHoras<0){
			alert('Debe seleccionar una hora de fin posterior a la de inicio.');
			objdateFin.value = 0;
			objdateIn.value = 0;
			var cantHoras = document.getElementById("pCantHoras");
			cantHoras.value = 0;
			calcularPrecio();
		}else{
			var cantHoras = document.getElementById("pCantHoras");
			cantHoras.value = parseInt(cantidadHoras);
			calcularPrecio();
			
			document.getElementById("pCantHoras").value
			if (document.getElementById("pCantHoras").value=="NaN"){
				var cantHoras = document.getElementById("pCantHoras");
				cantHoras.value = 0;
				calcularPrecio();
			}
		}


	}
	
	
<?php
$preciohora = 10;
?>
	
	function calcularPrecio() {
		var h = parseInt(document.getElementById("pCantHoras").value);

		var p = document.getElementById("pPrecio");
		p.value=<?=$preciohora;?>*h;

	}
	
	</script>
	
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
									<form method="post" action="#" id="Formulario">
									
										<input type="hidden" name="nombre" value="<?=$nombre?>">
										<input type="hidden" name="email" value="<?=$email?>">
										<input type="hidden" name="password" value="<?=$password?>">

										<div class="row gtr-uniform">
											<div class="col-6 col-12-xsmall">
												Fecha del evento.<br>
												<input type="date" name="fecha" id="fecha" value="">
											</div>
											<div class="col-6 col-12-xsmall">
											</div>
											
											<div class="col-6 col-12-xsmall">
												Hora de comienzo del evento.<br>
												<input type="time" name="HoraInicio" id="HoraInicio" value="">
											</div>
											
											<div class="col-6 col-12-xsmall">
												Hora de fin del evento.<br>
												<input type="time" name="HoraFin" id="HoraFin" value="">
											</div>
											
											
											<div class="col-6 col-12-xsmall">
											<h4> Resumen:</h4>
												Cantidad de horas: <input type="text" name="pCantHoras" id="pCantHoras" value="" readonly>
									
												Importe calculado: <input type="text" name="pPrecio" id="pPrecio" value="" readonly>
											</div>
											<br>
											
											
											
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