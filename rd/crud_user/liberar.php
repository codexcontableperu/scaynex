<?php include("./../../data/conexion.php"); ?>
<?php include('./../includes/session.php'); ?>

<?php


if (isset($_POST['guardar'])) {
$F = $_POST['FECHA'];
$NUSER = $_POST['USER']; 

  $query = "UPDATE usuarios set

user_disponible ='si'

  WHERE id_user=$NUSER";

  mysqli_query($conexion, $query);

}


mysqli_close($conexion);
  ?>
      <meta http-equiv="refresh" content="0;url=../rd_programaciones_read.php?f=<?php echo $F ; ?>#user" />   
    </div>

  <?php

exit();

?>