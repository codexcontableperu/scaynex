<?php include("../../data/conexion.php"); 
include('../includes/header.php');

if (isset($_POST['tabla'])) {
    $ID = $_POST['id'];
    $RD= $_POST['Id_SERG'];
    $tabla = $_POST['tabla'];
    $F = $_POST['f'];
    $KFS = $_POST['KM_FINAL_SERV'];    
    $HLB = $_POST['HORA_LLEGADA_BASE'];    
    $KLB= $_POST['KM_LLEGADA_BASE'];

    // Crear la consulta para actualizar la tabla
    $query = "UPDATE $tabla set

        Id_SERG  ='$RD',
        KM_FINAL_SERV ='$KFS',
        HORA_LLEGADA_BASE ='$HLB',
        KM_LLEGADA_BASE ='$KLB'
        
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
