<?php include("./../../data/conexion.php"); ?>

<?php 

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$idd = $_GET['idd'];
	$idp = $_GET['idp'];
	$idr= $_GET['idr'];


/*---query elimina---*/
$query= "DELETE FROM guias_remitente WHERE id_guiar= $id";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);

/*---query elimina---*/
$query= "DELETE FROM guias_transp WHERE gt_servicio= $idr";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);

          $query = "UPDATE hruta set GUIA_TRANSP = 'NO' WHERE id_ruta ='$idr'";
          mysqli_query($conexion, $query);


}

?>

<meta http-equiv="refresh" content="0;url=./../wt_ruta_descargas.php?idp=<?php echo $idp; ?>&idr=<?php echo $idr; ?>&idd=<?php echo $idd; ?>" /><?php
