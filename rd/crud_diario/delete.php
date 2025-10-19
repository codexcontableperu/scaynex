<?php include("./../../data/conexion.php"); ?>

<?php 

if (isset($_GET['id'])) {
	$ID = $_GET['id'];
    $RD = $_GET['rd'];
    $OP= $_GET['op'];

// CONSULTA DE FECHA DE REGISTROS DE DIARIO
  $query = "
  SELECT diario.ID_DIARIO, diario.FECHA_R
FROM diario
WHERE (((diario.ID_DIARIO)='$ID'));
  ";
  $result = mysqli_query($conexion, $query);
  $filas=mysqli_fetch_assoc($result);
  $FR=$filas ['FECHA_R'];
echo $FR;


/*---query elimina---*/
$query= "DELETE FROM diario WHERE FECHA_R= '$FR'";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);

if (!$result) {
	die('Invalid query: ' . mysqli_error());
	}

 echo '<script type="text/javascript">
    window.location.href="./../rd_diario_arendir.php?op=' . $OP . '&rd=' . $RD . '";
</script>';

exit();
}



?>