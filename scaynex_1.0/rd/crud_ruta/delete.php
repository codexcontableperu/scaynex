<?php include("./../../data/conexion.php"); ?>
<?php 



if (isset($_GET['idr'])) {

$idp=$_GET['idp'];
$idr=$_GET['idr'];

/*---query elimina---*/
$query= "DELETE FROM hruta WHERE id_ruta= $idr";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);



?><meta http-equiv="refresh" content="0;url=./../ruta_nuevo.php?idp=<?php echo $idp ?>" /><?php
}
?>