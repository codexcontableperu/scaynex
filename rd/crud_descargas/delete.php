<?php include("./../../data/conexion.php"); ?>

<?php 

if (isset($_GET['idd'])) {

	$idd= $_GET['idd'];
    $idp = $_GET['idp'];
    $idr = $_GET['idr'];

/*---query elimina---*/
$query= "DELETE FROM rd_descargas WHERE id_descaga= $idd";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);


}

?>

<meta http-equiv="refresh" content="0;url=./../wt_ruta_ruta.php?idp=<?php echo $idp; ?>&idr=<?php echo $idr; ?>" /><?php
