<?php include("./../../data/conexion.php"); ?>

<?php 

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$FECHA= $_GET["f"];
	
/*---query elimina---*/
$query= "DELETE FROM rd_segimientos_head WHERE Id_SERG= $id";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);
/*---query elimina---*/
$query= "DELETE FROM rd_operadores WHERE Id_SERG= $id";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);

if (!$result) {
	die('Invalid query: ' . mysqli_error());
	}

	mysqli_close($conexion);
	echo'<script type="text/javascript">
    window.location.href="./../rd_programaciones_read.php?f=' . $FECHA . '";
    </script>';

exit();
}



?>