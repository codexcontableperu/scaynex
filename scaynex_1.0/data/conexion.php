<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
date_default_timezone_set('America/Lima');

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'scaynex';

$conexion = new mysqli($servername, $username, $password, $database);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}



?>


<?php
/*
		$conexion = mysqli_connect(
		'localhost',
		'id14004671_sitarcin',		  
		'Peru_2020_codex',
		'id14004671_havrax'
		) or die(mysqli_erro($mysqli));
*/		  
?>