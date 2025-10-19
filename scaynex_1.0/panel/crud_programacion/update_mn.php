<?php include("./../../data/conexion.php"); ?>
<?php include('./../includes/session.php'); ?>

<?php

if (isset($_POST['guardar'])) {
    $S_FECHA = $_POST["S_FECHA"];
    $Id_SERG = $_POST["Id_SERG"];
    $PLACA = $_POST["PLACA"];
    $EPS = $_POST["EPS"];
    $TEMPERATURA = $_POST["TEMPERATURA"];
    $CONDUCTOR = $_POST["CONDUCTOR"];
    $AUXILIAR1 = $_POST["AUXILIAR1"];
    $AUXILIAR2 = $_POST["AUXILIAR2"];
    $AUXILIAR3 = $_POST["AUXILIAR3"];
    $SUPERVISOR = $_POST["SUPERVISOR"];
    $RESGUARDO = $_POST["RESGUARDO"];
    $TIPO_DESPACHO = $_POST["TIPO_DESPACHO"];
    $SERVICIOS = $_POST["SERVICIOS"];
    $ID_CLIENTE = $_POST["ID_CLIENTE"];
    $CUENTA = $_POST["CUENTA"];
    $EMPRESA = $_POST["EMPRESA"];
    $H_CITA = $_POST["H_CITA"];
    $H_CITA_R = $_POST["H_CITA_R"];
    $OBS_PROG = $_POST["OBS_PROG"];
    $S_USER = $_POST["S_USER"];

    $query = "UPDATE rd_segimientos_head SET
         
        EPS = '$EPS',  
        TEMPERATURA = '$TEMPERATURA',  
        PLACA = '$PLACA',
        CONDUCTOR = '$CONDUCTOR',
        AUXILIAR1 = '$AUXILIAR1',
        AUXILIAR2 = '$AUXILIAR2',
        AUXILIAR3 = '$AUXILIAR3',
        SUPERVISOR = '$SUPERVISOR',
        RESGUARDO = '$RESGUARDO',
        TIPO_DESPACHO = '$TIPO_DESPACHO',
        SERVICIOS = '$SERVICIOS',
        ID_CLIENTE = '$ID_CLIENTE',
        CUENTA = '$CUENTA',
        EMPRESA = '$EMPRESA',
        H_CITA = '$H_CITA',
        H_CITA_R = '$H_CITA_R',
        OBS_PROG = '$OBS_PROG',
        S_USER = '$S_USER'
    WHERE Id_SERG = $Id_SERG";

    mysqli_query($conexion, $query);
}


mysqli_close($conexion);

echo '<script type="text/javascript">
    window.location.href="./../programacion.php?f=' . $S_FECHA . '";
</script>';
exit();

?>
