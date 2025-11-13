<?php
// marcado.php (versión corregida - guarda centro_labores y distancia_metros)

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuración de zona horaria
date_default_timezone_set('America/Lima');

// Configuración de base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'icemnet');
define('DB_CHARSET', 'utf8mb4');

// Función para redireccionar con mensaje
function redirect($ok, $msg) {
    $url = '/ICEMNET/asistencia/home_asistencia.php?ok=' . ($ok ? '1' : '0') . '&msg=' . urlencode($msg);
    header('Location: ' . $url);
    exit;
}

// Verificar que sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect(false, 'Método no permitido. Usa el formulario.');
}

// Obtener datos del POST
$id_user = isset($_POST['id_user']) ? (int)$_POST['id_user'] : 0;
$tipo_marcado = isset($_POST['tipo_marcado']) ? trim($_POST['tipo_marcado']) : '';
$latitud = isset($_POST['latitud']) ? (float)$_POST['latitud'] : null;
$longitud = isset($_POST['longitud']) ? (float)$_POST['longitud'] : null;
$dispositivo = isset($_POST['dispositivo']) ? trim($_POST['dispositivo']) : '';
$motivo = isset($_POST['motivo']) ? trim($_POST['motivo']) : '';
$centro_labores = isset($_POST['centro_labores']) ? (int)$_POST['centro_labores'] : null;
$distancia_metros = isset($_POST['distancia_metros']) ? (int)$_POST['distancia_metros'] : null;

// Obtener datos del servidor
$ip_address = $_SERVER['REMOTE_ADDR'] ?? '';
$fecha_marcado = date('Y-m-d');
$hora_marcado = date('H:i:s');
$mes = (int)date('m');
$anio = (int)date('Y');

// Validaciones básicas
if ($id_user <= 0) {
    redirect(false, 'ID de usuario inválido.');
}

$tipos_validos = ['Entrada', 'Inicio Break', 'Fin Break', 'Salida', 'Especial'];
if (!in_array($tipo_marcado, $tipos_validos)) {
    redirect(false, 'Tipo de marcado inválido.');
}

if ($latitud === null || $longitud === null) {
    redirect(false, 'No se pudo obtener la ubicación.');
}

if (empty($dispositivo)) {
    redirect(false, 'No se pudo detectar el dispositivo.');
}

if ($centro_labores === null || $centro_labores <= 0) {
    redirect(false, 'No se pudo detectar el centro laboral.');
}

// Conectar a la base de datos
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    redirect(false, 'Error de conexión a la base de datos: ' . $e->getMessage());
}

// Preparar la consulta SQL (ahora incluye CENTRO_LABORES y DISTANCIA_METROS)
$sql = "INSERT INTO registro_asistencia 
    (ID_USER, TIPO_MARCADO, FECHA_MARCADO, HORA_MARCADO, LATITUD, LONGITUD, 
     DISPOSITIVO, DIRECCION_IP, MES, AÑO, ESTADO, OBSERVACIONES, CENTRO_LABORES, DISTANCIA_METROS) 
VALUES 
    (:id_user, :tipo_marcado, :fecha_marcado, :hora_marcado, :latitud, :longitud, 
     :dispositivo, :direccion_ip, :mes, :anio, :estado, :observaciones, :centro_labores, :distancia_metros)";

try {
    $stmt = $pdo->prepare($sql);
    
    // Ejecutar con los parámetros (ahora incluye centro_labores y distancia_metros)
    $resultado = $stmt->execute([
        ':id_user' => $id_user,
        ':tipo_marcado' => $tipo_marcado,
        ':fecha_marcado' => $fecha_marcado,
        ':hora_marcado' => $hora_marcado,
        ':latitud' => $latitud,
        ':longitud' => $longitud,
        ':dispositivo' => $dispositivo,
        ':direccion_ip' => $ip_address,
        ':mes' => $mes,
        ':anio' => $anio,
        ':estado' => 'Válida',
        ':observaciones' => $motivo,
        ':centro_labores' => $centro_labores,
        ':distancia_metros' => $distancia_metros
    ]);
    
    if ($resultado) {
        $id_insertado = $pdo->lastInsertId();
        redirect(true, "✅ Marcado registrado correctamente. ID: {$id_insertado} - Tipo: {$tipo_marcado} - Hora: {$hora_marcado}");
    } else {
        redirect(false, 'No se pudo registrar el marcado.');
    }
    
} catch (PDOException $e) {
    redirect(false, 'Error al insertar: ' . $e->getMessage());
}
?>