<?php
// Reporta todos los errores de PHP (bueno para desarrollo)
error_reporting(E_ALL);
ini_set('display_errors', 'on');

// Establece la zona horaria a America/Lima (Perú)
date_default_timezone_set('America/Lima');

// Configuración de la Base de Datos
$servername = 'localhost';
$username   = 'teletran_cristian';
$password   = 'c.rivera.a.2020';
$database   = 'teletran_scaynex';

// Crea la conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Configura el set de caracteres a UTF-8 para evitar problemas de acentos y ñ
$conexion->set_charset("utf8");

// Verifica si hay errores de conexión
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}