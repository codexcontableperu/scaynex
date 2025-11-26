<?php 
include("./../../data/conexion.php");

// Verificar conexión
if (!$conexion) {
    die('Error de conexión: ' . mysqli_connect_error());
}

// Recibir variable idp desde GET
if (isset($_GET['idp']) && !empty($_GET['idp'])) {
    $idp = $_GET['idp'];
    
    // Sanitizar el valor para prevenir SQL injection
    $idp = mysqli_real_escape_string($conexion, $idp);
    
    // Actualizar tabla rd_inicio_fin
    $query = "UPDATE rd_inicio_fin SET rcaja = 'si' WHERE Id_SERG = '$idp'";
    
    if (mysqli_query($conexion, $query)) {
        // Redirigir después de la actualización
        header("Location: ../wt_control_caja.php?idp=" . $idp);
        exit();
    } else {
        // Manejar error en la actualización
        echo "Error al actualizar: " . mysqli_error($conexion);
    }
} else {
    echo "No se recibió el parámetro idp";
}

// Cerrar conexión
mysqli_close($conexion);
?>