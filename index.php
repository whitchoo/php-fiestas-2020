<html>
    <head>
		<title>Fiestas 2020</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="CSSPhantom/assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
    </head>
		<h1>Bienvenido a la fiesta de cumpleaños de pepito!</h1>
		
		<script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
		<script src='https://meet.jit.si/external_api.js'></script>
		<script>
			function StartMeeting(){
				const domain = 'meet.jit.si';
				const options = {
					roomName: 'pruebamau',
					width: 700,
					height: 700,
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
    </head>
    <body>
        <button id='btnStart'>Start</button>
        <div class="container">
            <div id='jitsi-meet-conf-container'></div>
        </div>
    </body>
</html>