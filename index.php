<!DOCTYPE HTML>

<html>
	<head>
		<title>Generic - Phantom by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="CSSPhantom/assets/css/main.css" />
		<noscript><link rel="stylesheet" href="CSSPhantom/assets/css/noscript.css" /></noscript>
	</head>
	
				
		<script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
		<script src='https://meet.jit.si/external_api.js'></script>
		<script>
			function StartMeeting(){
				const domain = 'meet.jit.si';
				const options = {
					roomName: 'pruebamau',
					width: screen.width-200,
					height: 400,
					parentNode: document.querySelector('#jitsi-meet-conf-container'),
					
					userInfo: {
						email: 'pepito@micorreo.com',
						displayName: 'Invitado1'
					}
				};
				apiObj = new JitsiMeetExternalAPI(domain, options);
			}
		</script>
		
		
        <script>
            $(function(){
                $('#btnStart').on('click',function(){
                    StartMeeting();
                });
            });
            
        </script>
	
	
	
	
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="" class="logo">
									<span class="symbol"></span><span class="title">Bienvenido a la fiesta de cumpleaños de pepito!</span>
								</a>

							<!-- Nav -->
								<nav>
									<ul>
										<li><a href="#menu">Menu</a></li>
									</ul>
								</nav>

						</div>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<h2>Menu</h2>
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="generic.html">Ipsum veroeros</a></li>
							<li><a href="generic.html">Tempus etiam</a></li>
							<li><a href="generic.html">Consequat dolor</a></li>
							<li><a href="elements.html">Elements</a></li>
						</ul>
					</nav>
				</div>
				
				
				
				
				
				
				
				<!-- Main -->
					<div id="main">
						<div class="inner">
							<button id='btnStart'>Sala de video</button><br>
							<center>
							<div class="container">
								<div id='jitsi-meet-conf-container'></div>
							</div>
							</center>
						</div>
					</div>









				<!-- Footer -->
					<footer id="footer">
						<!--<div class="inner">
							<section>
								<h2>Get in touch</h2>
								<form method="post" action="#">
									<div class="fields">
										<div class="field half">
											<input type="text" name="name" id="name" placeholder="Name" />
										</div>
										<div class="field half">
											<input type="email" name="email" id="email" placeholder="Email" />
										</div>
										<div class="field">
											<textarea name="message" id="message" placeholder="Message"></textarea>
										</div>
									</div>
									<ul class="actions">
										<li><input type="submit" value="Send" class="primary" /></li>
									</ul>
								</form>
							</section>
							<section>
								<h2>Follow</h2>
								<ul class="icons">
									<li><a href="#" class="icon brands style2 fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon brands style2 fa-facebook-f"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon brands style2 fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon brands style2 fa-dribbble"><span class="label">Dribbble</span></a></li>
									<li><a href="#" class="icon brands style2 fa-github"><span class="label">GitHub</span></a></li>
									<li><a href="#" class="icon brands style2 fa-500px"><span class="label">500px</span></a></li>
									<li><a href="#" class="icon solid style2 fa-phone"><span class="label">Phone</span></a></li>
									<li><a href="#" class="icon solid style2 fa-envelope"><span class="label">Email</span></a></li>
								</ul>
							</section>
							
							
							-->
							<ul class="copyright">
								<li>&copy; xxxxxxx. All rights reserved</li><li>Design: xxxxxxxxxxxxx</li>
							</ul>
						</div>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="CSSPhantom/assets/js/jquery.min.js"></script>
			<script src="CSSPhantom/assets/js/browser.min.js"></script>
			<script src="CSSPhantom/assets/js/breakpoints.min.js"></script>
			<script src="CSSPhantom/assets/js/util.js"></script>
			<script src="CSSPhantom/assets/js/main.js"></script>

	</body>
</html>