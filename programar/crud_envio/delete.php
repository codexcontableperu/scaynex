<?php include("./../../data/conexion.php"); ?>

<?php 

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$u = $_GET['us'];
/*---query elimina---*/
$query= "DELETE FROM  ledger WHERE id_ledger= $id";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);

if (!$result) {
	die('Invalid query: ' . mysqli_error());
	}

}



?>

<meta http-equiv="refresh" content="0;url=./../envio_fondosxuser.php?us=<?php echo $u ?>" />