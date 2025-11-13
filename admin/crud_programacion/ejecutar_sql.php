<?php
/**
 * ejecutar_sql.php
 * Archivo para ejecutar sentencias SQL personalizadas desde el modal SQL
 * Ubicación: crud_programacion/ejecutar_sql.php
 */

// Incluir la conexión a la base de datos
include("../../data/conexion.php");

// Verificar que se haya enviado el formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ejecutar_sql'])) {
    
    // Obtener los datos del formulario
    $sql_personalizado = trim($_POST['sql_personalizado']);
    $fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : date('Y-m-d');
    $fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : date('Y-m-d');
    $busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : '';
    
    // Validar que se haya ingresado SQL
    if (empty($sql_personalizado)) {
        // Redirigir con error
        header("Location: ../programacion.php?sql_error=" . urlencode("No se ingresó ninguna sentencia SQL") . 
               "&fecha_inicio=$fecha_inicio&fecha_fin=$fecha_fin&busqueda=" . urlencode($busqueda));
        exit;
    }
    
    // Validación básica de seguridad: evitar comandos peligrosos
    $sql_lower = strtolower($sql_personalizado);
    $comandos_peligrosos = ['drop database', 'drop table', 'truncate', 'drop user', 'create user', 'grant all'];
    
    foreach ($comandos_peligrosos as $comando) {
        if (strpos($sql_lower, $comando) !== false) {
            header("Location: ../programacion.php?sql_error=" . urlencode("Comando SQL no permitido por seguridad: $comando") . 
                   "&fecha_inicio=$fecha_inicio&fecha_fin=$fecha_fin&busqueda=" . urlencode($busqueda));
            exit;
        }
    }
    
    // Intentar ejecutar el SQL
    try {
        // Deshabilitar autocommit para transacciones
        $conexion->autocommit(FALSE);
        
        // Ejecutar la consulta del usuario
        $resultado = $conexion->query($sql_personalizado);
        
        if ($resultado) {
            // Obtener información sobre la ejecución del SQL del usuario
            $filas_afectadas_usuario = $conexion->affected_rows;
            
            // *** EJECUTAR UPDATE AUTOMÁTICO PARA SINCRONIZAR IDs ***
            // Búsqueda flexible: ignora mayúsculas/minúsculas y espacios extras
            $sql_update_ids = "
                UPDATE rd_segimientos_head AS h
                LEFT JOIN usuarios AS u_cond ON (
                    LOWER(TRIM(h.CONDUCTOR)) = LOWER(TRIM(u_cond.user_nombre)) OR 
                    LOWER(TRIM(h.CONDUCTOR)) = LOWER(TRIM(u_cond.user_nick)) OR 
                    LOWER(TRIM(h.CONDUCTOR)) = LOWER(TRIM(u_cond.user_nick2)) OR 
                    LOWER(TRIM(h.CONDUCTOR)) = LOWER(TRIM(u_cond.firma))
                )
                LEFT JOIN usuarios AS u_aux1 ON (
                    LOWER(TRIM(h.AUXILIAR1)) = LOWER(TRIM(u_aux1.user_nombre)) OR 
                    LOWER(TRIM(h.AUXILIAR1)) = LOWER(TRIM(u_aux1.user_nick)) OR 
                    LOWER(TRIM(h.AUXILIAR1)) = LOWER(TRIM(u_aux1.user_nick2)) OR 
                    LOWER(TRIM(h.AUXILIAR1)) = LOWER(TRIM(u_aux1.firma))
                )
                LEFT JOIN usuarios AS u_aux2 ON (
                    LOWER(TRIM(h.AUXILIAR2)) = LOWER(TRIM(u_aux2.user_nombre)) OR 
                    LOWER(TRIM(h.AUXILIAR2)) = LOWER(TRIM(u_aux2.user_nick)) OR 
                    LOWER(TRIM(h.AUXILIAR2)) = LOWER(TRIM(u_aux2.user_nick2)) OR 
                    LOWER(TRIM(h.AUXILIAR2)) = LOWER(TRIM(u_aux2.firma))
                )
                LEFT JOIN usuarios AS u_aux3 ON (
                    LOWER(TRIM(h.AUXILIAR3)) = LOWER(TRIM(u_aux3.user_nombre)) OR 
                    LOWER(TRIM(h.AUXILIAR3)) = LOWER(TRIM(u_aux3.user_nick)) OR 
                    LOWER(TRIM(h.AUXILIAR3)) = LOWER(TRIM(u_aux3.user_nick2)) OR 
                    LOWER(TRIM(h.AUXILIAR3)) = LOWER(TRIM(u_aux3.firma))
                )
                SET 
                    h.ID_CONDUC = COALESCE(u_cond.id_user, IF(TRIM(h.CONDUCTOR) != '', 66, NULL)),
                    h.ID_AUX1 = COALESCE(u_aux1.id_user, IF(TRIM(h.AUXILIAR1) != '', 66, NULL)),
                    h.ID_AUX2 = COALESCE(u_aux2.id_user, IF(TRIM(h.AUXILIAR2) != '', 66, NULL)),
                    h.ID_AUX3 = COALESCE(u_aux3.id_user, IF(TRIM(h.AUXILIAR3) != '', 66, NULL))
                WHERE 
                    TRIM(COALESCE(h.CONDUCTOR, '')) != '' OR
                    TRIM(COALESCE(h.AUXILIAR1, '')) != '' OR
                    TRIM(COALESCE(h.AUXILIAR2, '')) != '' OR
                    TRIM(COALESCE(h.AUXILIAR3, '')) != ''
            ";
            
            $resultado_update = $conexion->query($sql_update_ids);
            
            if ($resultado_update) {
                // Obtener filas afectadas por el UPDATE
                $filas_afectadas_update = $conexion->affected_rows;
                
                // Commit si ambas consultas fueron exitosas
                $conexion->commit();
                
                // Cerrar conexión
                $conexion->close();
                
                // Redirigir con éxito
                header("Location: ../programacion.php?sql_success=1" . 
                       "&fecha_inicio=$fecha_inicio&fecha_fin=$fecha_fin&busqueda=" . urlencode($busqueda));
                exit;
            } else {
                // Rollback si el UPDATE falla
                $conexion->rollback();
                
                $error_msg = "SQL del usuario ejecutado, pero falló la sincronización de IDs: " . $conexion->error;
                
                $conexion->close();
                
                header("Location: ../programacion.php?sql_error=" . urlencode($error_msg) . 
                       "&fecha_inicio=$fecha_inicio&fecha_fin=$fecha_fin&busqueda=" . urlencode($busqueda));
                exit;
            }
            
        } else {
            // Rollback en caso de error
            $conexion->rollback();
            
            // Capturar error de MySQL
            $error_msg = $conexion->error;
            
            // Cerrar conexión
            $conexion->close();
            
            // Redirigir con error
            header("Location: ../programacion.php?sql_error=" . urlencode($error_msg) . 
                   "&fecha_inicio=$fecha_inicio&fecha_fin=$fecha_fin&busqueda=" . urlencode($busqueda));
            exit;
        }
        
    } catch (Exception $e) {
        // Rollback en caso de excepción
        $conexion->rollback();
        
        // Cerrar conexión
        $conexion->close();
        
        // Redirigir con error de excepción
        header("Location: ../programacion.php?sql_error=" . urlencode($e->getMessage()) . 
               "&fecha_inicio=$fecha_inicio&fecha_fin=$fecha_fin&busqueda=" . urlencode($busqueda));
        exit;
    }
    
} else {
    // Si no se envió por POST, redirigir a programacion.php
    header("Location: ../programacion.php");
    exit;
}
?>