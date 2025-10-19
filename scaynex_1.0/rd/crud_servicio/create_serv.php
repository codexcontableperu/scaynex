<?php include("./../../data/conexion.php"); ?>
<?php 
/*---NEW ---*/

if (isset($_POST['guardar'])) {
    $idp = $_POST['Id_SERG'];
    $FECHA_SERV = $_POST['FECHA_SERV'];
    $Id_SERG = $_POST['Id_SERG'];
    $user_serv = $_POST['user_serv'];    
    $EPS = $_POST['EPS'];
    $PLACA = $_POST['PLACA'];
    $TEMPERATURA = $_POST['TEMPERATURA'];
    $CONDUCTOR = $_POST['CONDUCTOR'];    
    $AUXILIAR1 = $_POST['AUXILIAR1'];
    $AUXILIAR2 = $_POST['AUXILIAR2'];
    $AUXILIAR3 = $_POST['AUXILIAR3'];
    $SUPERVISOR = $_POST['SUPERVISOR'];
    $CONTACTO_CTA = $_POST['CONTACTO_CTA'];
    $CLIENTE = $_POST['CLIENTE'];
    $CUENTA = $_POST['CUENTA'];
    $CTE_TERCERO = $_POST['CTE_TERCERO'];
    $TIPO_PROG = $_POST['TIPO_PROG'];
    $TIPO_DESPACHO = $_POST['TIPO_DESPACHO'];    
    $OBSERVACION_SERV = $_POST['OBSERVACION_SERV'];
    $NBULTOS = $_POST['NBULTOS'];
    $PALETAS = $_POST['PALETAS'];
    $DATALOGGER = $_POST['DATALOGGER'];
    $H_CITA = $_POST['H_CITA'];
    $H_CITA_R = $_POST['H_CITA_R'];
    $RESGUARDO = $_POST['RESGUARDO'];



    $query = "INSERT INTO rd_servicio (
        FECHA_SERV, 
        Id_SERG, EPS, 
        TEMPERATURA, 
        TIPO_PROG,
        TIPO_DESPACHO, 
        PLACA, 
        CONDUCTOR, 
        AUXILIAR1, 
        AUXILIAR2, 
        AUXILIAR3, 
        SUPERVISOR, 
        CONTACTO_CTA,
        CUENTA, 
        CLIENTE, 
        CTE_TERCERO, 
        H_CITA, 
        H_CITA_R, 
        NBULTOS, 
        PALETAS, 
        DATALOGGER, 
        RESGUARDO, 
        OBSERVACION_SERV, 
        user_serv
    ) VALUES (
        '$FECHA_SERV', 
        '$Id_SERG', 
        '$EPS', 
        '$TEMPERATURA', 
        '$TIPO_PROG', 
        '$TIPO_DESPACHO',
        '$PLACA', 
        '$CONDUCTOR', 
        '$AUXILIAR1', 
        '$AUXILIAR2', 
        '$AUXILIAR3', 
        '$SUPERVISOR',
        '$CONTACTO_CTA',
        '$CUENTA', 
        '$CLIENTE', 
        '$CTE_TERCERO', 
        '$H_CITA', 
        '$H_CITA_R', 
        '$NBULTOS', 
        '$PALETAS', 
        '$DATALOGGER', 
        '$RESGUARDO', 
        '$OBSERVACION_SERV', 
        '$user_serv'
    )";

    /*--- Ejecutar la consulta ---*/
    $result = mysqli_query($conexion, $query);




   mysqli_close($conexion);
        echo '<script type="text/javascript">
            window.location.href="./../wt_panel_user.php?idp=' . $idp. '";
        </script>';

     }?>