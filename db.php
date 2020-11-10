<?php

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

if ($_SERVER['HTTP_HOST']=='localhost'){
	$link = mysqli_connect("localhost", "root", "", "eventosonline");
}else{
	// $link = mysqli_connect("localhost", "id15295825_fiestasonline", "(nyH*0zAF%zVC/Cj", "id15295825_eventosonline");
	$link = mysqli_connect("127.0.0.1:3306", "u269343228_Fiestasonline", '$md3LOKw;M5', "u269343228_eventosonline");
}
// Check connection
if($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}


?>