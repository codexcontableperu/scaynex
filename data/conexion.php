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
$servername = 'localhost';
$username   = 'teletran_cristian';
$password   = 'c.rivera.a.2020';
$database   = 'teletran_scaynex';
*/		  
?>