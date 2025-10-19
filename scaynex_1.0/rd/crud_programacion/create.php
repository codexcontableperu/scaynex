<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW programacion---*/

if (isset($_POST['guardar'])) {
 $S_FECHA = $_POST["S_FECHA"];
 $S_USER = $_POST["id_user"];
 $PLACA = $_POST["PLACA"];
 $ESTADO = 1;
$query= "INSERT INTO  rd_segimientos_head(  

S_FECHA,
PLACA,
S_USER,
ESTADO_IDP 

) VALUES (

'$S_FECHA',
'$PLACA',
'$S_USER',
'$ESTADO'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);


/*---secion para msj ---*/

/*---redireccion ---*/
mysqli_close($conexion);   

 echo '<script type="text/javascript">
    window.location.href="./../rd_programaciones_read.php?f=' . $S_FECHA . '";
</script>';


}



if (isset($_POST['guardarp'])) {
 $S_FECHA = $_POST["S_FECHA"];
 $S_USER = $_POST["id_user"];
 $PLACA = $_POST["PLACA"];

$query="
SELECT * FROM rd_segimientos_pll
WHERE (((rd_segimientos_pll.PLACA)='$PLACA'))";
$result=mysqli_query($conexion, $query);
$filas=mysqli_fetch_assoc($result);

$CONDUCTOR =$filas ['CONDUCTOR'];
$AUXILIAR1 =$filas ['AUXILIAR1'];
$AUXILIAR2 =$filas ['AUXILIAR2'];
$AUXILIAR3 =$filas ['AUXILIAR3'];
$SERVICIOS =$filas ['SERVICIOS'];
$ID_CLIENTE =$filas ['ID_CLIENTE'];
$H_CITA =$filas ['H_CITA'];
$EPS =$filas ['EPS'];
$TEMPERATURA=$filas ['TEMPERATURA'];

$query= "INSERT INTO  rd_segimientos_head(  

S_FECHA,
EPS,
TEMPERATURA,
PLACA,
CONDUCTOR,
AUXILIAR1,
AUXILIAR2,
AUXILIAR3,
SERVICIOS,
ID_CLIENTE,
H_CITA,
S_USER



) VALUES (

'$S_FECHA',
'$EPS',
'$TEMPERATURA',
'$PLACA',
'$CONDUCTOR',
'$AUXILIAR1',
'$AUXILIAR2',
'$AUXILIAR3',
'$SERVICIOS',
'$ID_CLIENTE',
'$H_CITA',
'$S_USER'



)";

/*---create ---*/
$result = mysqli_query($conexion, $query);


/*---secion para msj ---*/

/*---redireccion ---*/
mysqli_close($conexion);   

 echo '<script type="text/javascript">
    window.location.href="./../rd_programaciones_read.php?f=' . $S_FECHA . '";
</script>';


}
?>
