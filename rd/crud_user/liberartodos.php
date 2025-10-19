<?php include("./../../data/conexion.php"); ?>
<?php include('./../includes/session.php'); ?>

<?php


if (isset($_GET['f'])) {
$F = $_GET['f'];


  $query = "UPDATE usuarios set

user_disponible ='si'

  WHERE id_user >0";

  mysqli_query($conexion, $query);


}


mysqli_close($conexion);

 echo '<script type="text/javascript">
    window.location.href="./../rd_programaciones_read.php?f=' . $F . '";
</script>';


exit();

?>