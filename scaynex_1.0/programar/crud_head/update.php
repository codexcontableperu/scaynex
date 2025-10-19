<?php include("./../data/conexion.php"); ?>


<?php

if (isset($_GET['id'])) {

	  $id = $_GET['id'];
  $c2 = 1;
  $c3 = $_POST['head_fecha'];
  $c4 = $_POST['head_nombre'];
  $c5 = $_POST['id_cliente'];
  $c6 = $_POST['id_user'];


/// actualisa tabla

  $query = "UPDATE head_programaciones set 
  id_emp = '$c2',
  head_fecha = '$c3',
  head_nombre = '$c4', 
  id_cliente = '$c5',
  id_user = '$c6'

  WHERE id_head=$id";

  mysqli_query($conexion, $query);


mysqli_close($conexion);
echo'<script type="text/javascript">
    window.location.href="./../head_create_read.php";
    </script>';

exit();
die();

}

?>