<?php include("./../data/conexion.php"); ?>
<?php 

if (isset($_GET['id'])) {
	$id = $_GET['id'];
/*---query elimina---*/
$query= "DELETE FROM head_programaciones WHERE id_head= $id";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);

if (!$result) {
	die('Invalid query: ' . mysqli_error());
	}

	mysqli_close($conexion);
	echo'<script type="text/javascript">
    window.location.href="./../head_create_read.php";
    </script>';

exit();
}



?>