<?php
include("includes/header.php");
include("../data/conexion.php");

// Verificar permisos y sesión
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_registro = (int)$_GET['id'];
    
    // Verificar que el registro existe
    $sql_verificar = "SELECT * FROM rd_segimientos_head WHERE Id_SERG = $id_registro";
    $resultado_verificar = $conexion->query($sql_verificar);
    
    if ($resultado_verificar->num_rows > 0) {
        // Eliminar el registro
        $sql_eliminar = "DELETE FROM rd_segimientos_head WHERE Id_SERG = $id_registro";
        
        if ($conexion->query($sql_eliminar)) {
            echo "<script>
                alert('Registro eliminado correctamente');
                window.location.href = 'programacion.php';
            </script>";
        } else {
            echo "<script>
                alert('Error al eliminar el registro: " . $conexion->error . "');
                window.location.href = 'programacion.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('El registro no existe');
            window.location.href = 'programacion.php';
        </script>";
    }
} else {
    echo "<script>
        alert('ID de registro no válido');
        window.location.href = 'programacion.php';
    </script>";
}

$conexion->close();
?>