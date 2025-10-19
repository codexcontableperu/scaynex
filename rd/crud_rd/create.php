<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ASISTENCIA---*/

if (isset($_POST['guardar'])) {
 $S_FECHA = $_POST["S_FECHA"];
 $PLACA = $_POST["PLACA"];
 $S_USER = $_POST["id_user"];


$query= "INSERT INTO  rd_segimientos_head(  

S_FECHA,
PLACA,
S_USER 

) VALUES (

'$S_FECHA',
'$PLACA',
'$S_USER'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);


/*---secion para msj ---*/

/*---redireccion ---*/
mysqli_close($conexion);	

 echo '<script type="text/javascript">
    window.location.href="./../segimientos_read.php?f=' . $S_FECHA . '";
</script>';


}

?>