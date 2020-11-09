<!DOCTYPE HTML> 

<html>
	<head>
		<title>Eventos Online</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="CSSPhantom/assets/css/main.css" />
		<noscript><link rel="stylesheet" href="CSSPhantom/assets/css/noscript.css" /></noscript> 
	</head>
	
	

<?php ///RECEPCION DE PARAMETROS
	$idEvento = $_POST["idEvento"];
	
?>


				
	<script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
			
	<body class="is-preload">
		<!-- Wrapper -->
		<div id="wrapper">

			<!-- Header -->
			<header id="header">
				<div class="inner">
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
					<h1>Validación de invitación a evento</h1>
					
					<h3><span class="image left"><img src="images/robotsmall.png" alt=""  /></span>Robotcete dice...</h3>
					
					
					
					<?php

				// Attempt select query execution
				$sql = "SELECT idEvento,fechaHoraInicio,fechaHoraFin, password ,fechaHoraInicio,DATE_ADD(fechaHoraInicio, INTERVAL -30 MINUTE) AS 'inicioPermitido' ";
				$sql = $sql."FROM Eventos WHERE idEvento = '".$idEvento."' and enabled = 1 ";
				$sql = $sql."AND fechaHoraFin >=NOW()";


				//echo $sql;
				if($result = mysqli_query($link, $sql)){
					if(mysqli_num_rows($result) > 0){
						if ($row = mysqli_fetch_array($result)){
							$inicioEvento = $row['fechaHoraInicio'];
							$inicioPermitido = strtotime($row['inicioPermitido']);
							//verificamos si ya el horario está listo para ingresar.
							$now    = time();
							$diff   = ($now - $inicioPermitido);
							//echo $diff;
							if ($diff >= 0) {
								/***********************ACCESO AL EVENTO!!!!*******************/
								header("Location: eventPreparation.php?idEvento=".$idEvento);
								echo "<h4>Puedes pasar!</h4>";
							}else{
								echo "<h4>Has llegado temprano!</h4><p>Las puertas del evento se abren 30 minutos antes del comienzo...</p>.";
							}
							
							



						}
						mysqli_free_result($result);
					} else{
						echo "<h4>Código incorrecto!</h4><p>El código que has ingresado no es válido.</p>.";
					}
				} else{
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
				}
				 
				// Close connection
				mysqli_close($link);
			?>
					
					<p></p>
					<p></p>

					
					
					<form  method="post" action="index.php"><br>
						<input type="submit" value="Volver a página principal" class="primary" />
					</form>
					
					
				</div>
			</div>
			
			<br><br><br><br><br><br><br><br><br><br><br><br>
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