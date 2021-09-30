<?php
$whitelist = array('127.0.0.1', "::1",'192.168.1.17');
if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
    /* LOCALHOST */
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "quematic";
	$conn = new mysqli($servername, $username, $password, $dbname);
}else{
	/* ONLINE */
	$servername = "mysql.hostinger.ph";
	$username = "u248631421_loadapi";
	$password = "Mikeelyn_113012";
	$dbname = "u248631421_loadapi";
	$conn = new mysqli($servername, $username, $password, $dbname);
}

function sanitize($input){
	global $conn;
	$output = mysqli_real_escape_string($conn, $input);
	return $output;
}

?>