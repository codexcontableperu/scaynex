<?php
include("./../../data/conexion.php");

// Validar que llega el id
if (isset($_GET['id'])) {
    $id_operacion = intval($_GET['id']);
    $id_programacion = intval($_GET['idp']);

    // Consulta para eliminar
    $query = "DELETE FROM rd_control_cuentas WHERE id_operacion = $id_operacion";

    if (mysqli_query($conexion, $query)) {
        // Redireccionamos al panel del usuario con id de programación
        if (!empty($id_programacion)) { // ← AQUÍ FALTABA EL PARÉNTESIS DE CIERRE
            // Si $id_programacion existe y es diferente de 0 o null
            echo '<script type="text/javascript">
                window.location.href="./../wt_panel_user.php?idp=' . $id_programacion . '";
            </script>';
            exit;
        } else {
            // Caso contrario
            echo '<script type="text/javascript">
                window.location.href="./../wt_prog_user.php";
            </script>';
            exit;
        }
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conexion);
    }
} else {
    echo "ID de operación no válido.";
}

mysqli_close($conexion);
?>
