<?php include("../../data/conexion.php"); 
include('../includes/header.php');

if (isset($_POST['tabla'])) {
    $ID = $_POST['id'];
    $RD= $_POST['Id_SERG'];
    $tabla = $_POST['tabla'];
    $F = $_POST['f'];
    $HSB = $_POST['HORA_SALIDA_BASE'];
    $KSB = $_POST['KM_SALIDA_BASE'];
    $HIA = $_POST['HORA_INGRESO_ALM'];
    $KLA = $_POST['KM_LLEGADA_ALM'];
    $HSA = $_POST['HORA_SALIDA_ALM'];
 

    // Crear la consulta para actualizar la tabla
    $query = "UPDATE $tabla set

        Id_SERG  ='$RD',
        HORA_SALIDA_BASE ='$HSB',
        KM_SALIDA_BASE ='$KSB',
        HORA_INGRESO_ALM ='$HIA',
        KM_LLEGADA_ALM ='$KLA',
        HORA_SALIDA_ALM  ='$HSA'

    WHERE ID_IF = $ID";

    // Actualizar la tabla
    mysqli_query($conexion, $query);

    mysqli_close($conexion);

        echo '<script type="text/javascript">
            window.location.href="./../segimientos_read.php?f=' . $F. '";
        </script>';

    exit();
}
?>
