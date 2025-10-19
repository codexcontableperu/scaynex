<?php include("../../data/conexion.php");  

if (isset($_GET['id'])) {
    $ID = $_GET['id'];
    $RD= $_GET['rd'];
	$tabla = $_GET['t'];

$query1 = "SHOW KEYS FROM $tabla WHERE Key_name = 'PRIMARY'";
$result1 = mysqli_query($conexion, $query1);

// Obtener el nombre de la columna de índice primario
$indice = '';
while ($row = mysqli_fetch_assoc($result1)) {
    $indice = $row['Column_name'];
    break;  // Tomamos la primera columna de la clave primaria
}


/*---query elimina---*/
$query= "DELETE FROM $tabla WHERE $indice= $ID";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);


if (!$result) {
	die('Invalid query: ' . mysqli_error());
	}

	mysqli_close($conexion);
        echo '<script type="text/javascript">
            window.location.href="./../' . $tabla . '_read.php?rd=' . $RD. '";
        </script>';
	exit();
}

?>