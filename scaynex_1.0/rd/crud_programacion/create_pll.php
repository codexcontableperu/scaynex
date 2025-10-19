<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW programacion---*/

if (isset($_POST['guardar'])) {
 $S_FECHA = $_POST["S_FECHA"];
 $S_USER = $_POST["id_user"];

  // consulta de ta tabla plantilla
  $query = "SELECT * FROM rd_segimientos_pll";
  $result = mysqli_query($conexion, $query);


while($filas=mysqli_fetch_assoc($result)) { 

$PLACA = $filas ['PLACA'] ;
$CONDUCTOR = $filas ['CONDUCTOR'] ;
$AUXILIAR1 = $filas ['AUXILIAR1'] ;
$AUXILIAR2 = $filas ['AUXILIAR2'] ;
$AUXILIAR3 = $filas ['AUXILIAR3'] ;
$ID_CLIENTE = $filas ['ID_CLIENTE'] ;
$SERVICIOS = $filas ['SERVICIOS'] ;
$H_CITA = $filas ['H_CITA'] ;



$query1= "INSERT INTO  rd_segimientos_head(  

S_FECHA,
PLACA,
S_USER,
CONDUCTOR,
AUXILIAR1,
AUXILIAR2,
AUXILIAR3,
ID_CLIENTE,
SERVICIOS,
H_CITA

) VALUES (

'$S_FECHA',
'$PLACA',
'$S_USER',
'$CONDUCTOR',
'$AUXILIAR1',
'$AUXILIAR2',
'$AUXILIAR3',
'$ID_CLIENTE',
'$SERVICIOS',
'$H_CITA'

)";

/*---create ---*/
$result1 = mysqli_query($conexion, $query1);

}



/*---redireccion ---*/
mysqli_close($conexion);   

 echo '<script type="text/javascript">
    window.location.href="./../rd_programaciones_read.php?f=' . $S_FECHA . '";
</script>';


}

?>