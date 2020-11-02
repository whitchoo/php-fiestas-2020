<html>
    <head>
		<title>Fiestas 2020</title>
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
					parentNode: document.querySelector('#jitsi-meet-conf-container')
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