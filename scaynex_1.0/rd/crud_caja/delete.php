<?php include("./../../data/conexion.php"); ?>

<?php 

if (isset($_GET['id_dt'])) {

	$id_dt= $_GET['id_dt'];
    $idp = $_GET['idp'];
    $idr = $_GET['idr'];

/*---query elimina---*/
$query= "DELETE FROM rd_dataloger WHERE id_dt= $id_dt";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);

echo '<script type="text/javascript">
    window.location.href="./../wt_ruta_dataloger.php?idp=' . $idp . '&idr=' . $idr . '&id=' . $id_dt . '";
</script>';
}

?>


