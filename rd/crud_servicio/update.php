<?php include("../../data/conexion.php"); 


if (isset($_POST['guardar'])) {
    $idr = $_POST["idr"];
    $idp = $_POST["idp"];

// Obtener valores del formulario

$EPS = $_POST["EPS"];
$TEMPERATURA = $_POST["TEMPERATURA"];
$TIPO_PROG = $_POST["TIPO_PROG"];
$PLACA = $_POST["PLACA"];
$CONDUCTOR = $_POST["CONDUCTOR"];
$AUXILIAR1 = $_POST["AUXILIAR1"];
$AUXILIAR2 = $_POST["AUXILIAR2"];
$AUXILIAR3 = $_POST["AUXILIAR3"];
$SUPERVISOR = $_POST["SUPERVISOR"];
$CUENTA = $_POST["CUENTA"];
$CLIENTE = $_POST["CLIENTE"];
$CTE_TERCERO = $_POST["CTE_TERCERO"];
$NBULTOS = $_POST["NBULTOS"];
$PALETAS = $_POST["PALETAS"];
$DATALOGGER = $_POST["DATALOGGER"];
$RESGUARDO = $_POST["RESGUARDO"];
$OBSERVACION_SERV = $_POST["OBS_PROG"];



    // Actualizar la tabla
  $query = "UPDATE rd_servicio set

    EPS = '$EPS',
    TEMPERATURA = '$TEMPERATURA',
    TIPO_PROG = '$TIPO_PROG',
    PLACA = '$PLACA',
    CONDUCTOR = '$CONDUCTOR',
    AUXILIAR1 = '$AUXILIAR1',
    AUXILIAR2 = '$AUXILIAR2',
    AUXILIAR3 = '$AUXILIAR3',
    SUPERVISOR = '$SUPERVISOR',
    CUENTA = '$CUENTA',
    CLIENTE = '$CLIENTE',
    CTE_TERCERO = '$CTE_TERCERO',
    NBULTOS = '$NBULTOS',
    PALETAS = '$PALETAS',
    DATALOGGER = '$DATALOGGER',
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
