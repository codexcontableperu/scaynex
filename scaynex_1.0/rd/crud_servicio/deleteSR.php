<?php include("../../data/conexion.php");  

if (isset($_GET['ids'])) {
    $ids = $_GET['ids'];
 $idp= $_GET['idp'];
/*---query elimina---*/
$query= "DELETE FROM rd_servicio WHERE ID_SERV= $ids";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);

/*---query elimina---*/
$query= "DELETE FROM hruta WHERE id_serv= $ids";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);




if (!$result) {
	die('Invalid query: ' . mysqli_error());
	}

	mysqli_close($conexion);
        echo '<script type="text/javascript">
            window.location.href="./../wt_panel_user.php?idp=' . $idp. '";
        </script>';
}

?>