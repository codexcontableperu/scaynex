<?php
// procesar_solicitud.php - VERSIÓN LIMPIA SIN OUTPUT EXTRA
header('Content-Type: application/json; charset=utf-8');
include("./../../data/conexion.php");

if (!isset($conexion) || !$conexion || $conexion->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Error de conexión a la base de datos']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
    exit();
}

if (!isset($_POST['id_guiar']) || !isset($_POST['accion'])) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit();
}

$id_guia = intval($_POST['id_guiar']);
$accion = trim($_POST['accion']);

if ($id_guia <= 0 || $accion !== 'solicitar') {
    echo json_encode(['success' => false, 'error' => 'Datos inválidos']);
    exit();
}

$conexion->begin_transaction();

try {
    $sql_verificar = "SELECT id_guiar, GUIA_TRANS FROM guias_remitente WHERE id_guiar = ? FOR UPDATE";
    $stmt_verificar = $conexion->prepare($sql_verificar);
    
    if (!$stmt_verificar) throw new Exception('Error al preparar la verificación');
    
    $stmt_verificar->bind_param("i", $id_guia);
    if (!$stmt_verificar->execute()) throw new Exception('Error al ejecutar la verificación');
    
    $resultado = $stmt_verificar->get_result();
    if ($resultado->num_rows === 0) throw new Exception('Guía no encontrada');
    
    $guia = $resultado->fetch_assoc();
    $estado_actual = strtolower(trim($guia['GUIA_TRANS']));
    $stmt_verificar->close();
    
    if ($estado_actual !== 'pendiente') throw new Exception('Guía ya procesada');
    
    $sql_actualizar = "UPDATE guias_remitente SET GUIA_TRANS = 'solicitado' WHERE id_guiar = ?";
    $stmt_actualizar = $conexion->prepare($sql_actualizar);
    
    if (!$stmt_actualizar) throw new Exception('Error al preparar la actualización');
    
    $stmt_actualizar->bind_param("i", $id_guia);
    if (!$stmt_actualizar->execute()) throw new Exception('Error al ejecutar la actualización');
    
    $conexion->commit();
    $stmt_actualizar->close();
    
    echo json_encode([
        'success' => true, 
        'message' => 'Guía solicitada correctamente',
        'id_guia' => $id_guia,
        'nuevo_estado' => 'solicitado'
    ]);
    
} catch (Exception $e) {
    $conexion->rollback();
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

if (isset($conexion)) $conexion->close();
exit();
?>