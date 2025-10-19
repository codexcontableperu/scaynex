
<?php include("./../../data/conexion.php"); ?>
<?php 

if (isset($_GET['id'])) {
	$id = $_GET['id'];
/*---query elimina---*/
$query= "DELETE FROM ledger WHERE id_ledger= $id";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);

if (!$result) {
	die('Invalid query: ' . mysqli_error());
	}

	mysqli_close($conexion);
	echo'<script type="text/javascript">
    window.location.href="./../rendiciones.php";
    </script>';

exit();
}



?>