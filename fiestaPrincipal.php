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
	$nombre = $_POST["nombre"];
	$kudos = $_POST["kudos"];
	
	//echo $idEvento.'<br>';
	//echo $nombre.'<br>';
	//echo $kudos.'<br>';
?>

	<script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
		<script src='https://meet.jit.si/external_api.js'></script>
		<script>

			function StartMeeting(){
				if (document.getElementById('flagshowvideo').value=='si'){
					const domain = 'meet.jit.si';
					const options = {
						roomName: "<?= $idEvento?>",
						width: screen.width-(screen.width/5),
						height: 400,
						parentNode: document.querySelector('#jitsi-meet-conf-container'),
						
					/**/	
						hideLobbyButton: true,
						requireDisplayName: false,
						enableWelcomePage: false,
						/*noticeMessage: 'Felicidades Pepito!',*/
						disableInviteFunctions: true,
			
						
						interfaceConfigOverwrite: { 
													APP_NAME: '<?=$idEvento?>',
													JITSI_WATERMARK_LINK: 'https://google.com',
													DISPLAY_WELCOME_PAGE_CONTENT: false
													},
						
					/**/		
						
						userInfo: {
							/*email: 'pepito@micorreo.com',*/
							displayName: '<?=$nombre?>'
						}
					};
					apiObj = new JitsiMeetExternalAPI(domain, options);
					document.getElementById('flagshowvideo').value='no';
				}
			}
		</script>
		
		
        <script>
            
			$(function(){ /////funciones a ejecutar al arrancar la página 
					//$('#btnStart').on('click',function(){   //LISTENER!... usar este if para detectar el onclick del boton con id btnStart
						StartMeeting();
					//});
            });
            
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
						
							<h4>Bienvenido/a! </h4>
							<p> Esta es la p&aacute;gina del evento. A continuaci&oacute;n tienes una videollamada para interactuar con el resto de invitados.</p>
						
							<input type="hidden" id="flagshowvideo" value="si"></input>
							<!--<button id='btnStart'>Sala de video</button><br>-->
							<center>
							<div class="container">
								<div id='jitsi-meet-conf-container'></div>
							</div>
							</center>
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