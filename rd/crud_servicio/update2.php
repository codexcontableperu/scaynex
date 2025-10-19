<?php include("../../data/conexion.php"); 


if (isset($_POST['guardar'])) {


    $idr = $_POST["idr"];
    $idp = $_POST["idp"];



// Obtener valores del formulario


$NBULTOS = $_POST["NBULTOS"];
$PALETAS = $_POST["PALETAS"];
$RESGUARDO = $_POST["RESGUARDO"];
$OBSERVACION_SERV = $_POST["OBS_PROG"];



    // Actualizar la tabla
  $query = "UPDATE rd_servicio set

    serv_actualizado = 'SI',
    NBULTOS = '$NBULTOS',
    PALETAS = '$PALETAS',
    RESGUARDO = '$RESGUARDO',
    OBSERVACION_SERV = '$OBSERVACION_SERV'

  WHERE  ID_SERV =$idr ";
    mysqli_query($conexion, $query);

}

mysqli_close($conexion);

echo '<script type="text/javascript">
    window.location.href="./../wt_ruta_ruta.php?idp=' . $idp . '&idr=' . $idr . '";
</script>';

?>
