<?php include("./../../data/conexion.php"); ?>
<?php include('./../includes/session.php'); ?>

<?php


if (isset($_GET['id'])) {
$id = $_GET['id'];
$activar = $_GET['a']; 

if ($activar=="si") {
  $activa =  'no';
} elseif ($activar=="no"){
  $activa =  'si';
}


$query = "
UPDATE usuarios 
SET user_activo = '" . $activa . "' 
WHERE id_user = " . $id;

mysqli_query($conexion, $query);
}

$resultado = mysqli_query($conexion, $query);
if (!$resultado) {
    printf("Error en la consulta SQL: %s\n", mysqli_error($conexion));
}


mysqli_close($conexion);
echo'<script type="text/javascript">
    window.location.href="./../user_listado.php";
    </script>';
exit();

?>