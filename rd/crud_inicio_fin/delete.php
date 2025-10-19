<?php include("./../../data/conexion.php"); ?>

<?php 

if (isset($_GET['id'])) {
	$id = $_GET['id'];

	
/*---query elimina---*/
$query= "DELETE FROM rd_segimientos_pll WHERE Id_pll= $id";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);

if (!$result) {
	die('Invalid query: ' . mysqli_error());
	}

	mysqli_close($conexion);
	echo'<script type="text/javascript">
    window.location.href="./../rd_plantilla_read.php";
    </script>';

exit();
}



?>