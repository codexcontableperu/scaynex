<?php include("./../data/conexion.php"); ?>


<?php

if (isset($_GET['id'])) {

	  $id = $_GET['id'];
  $c2 = $_POST['id_head'];
  $c3 = $_POST['id_cta'];
  $c4 = $_POST['vh_asignado'];
  $c5 = $_POST['vh_reportado'];
  $c6 = $_POST['id_conductor'];
  $c7 = $_POST['id_ayudante'];
  $c8 = $_POST['cant_estiva'];
  $c9 = $_POST['id_tprog'];
  $c10 = $_POST['id_estado'];
  $c13 = $_POST['obs_prog'];


/// actualisa tabla

  $query = "UPDATE programaciones set 
  id_head = '$c2',
  id_cta = '$c3',
  vh_asignado = '$c4', 
  vh_reportado = '$c5',
  id_conductor = '$c6',
  id_ayudante = '$c7',
  cant_estiva = '$c8',
  id_tprog = '$c9',
  id_estado = '$c10',
  obs_prog = '$c13'


  WHERE id_prog=$id";

  mysqli_query($conexion, $query);


mysqli_close($conexion);
echo'<script type="text/javascript">
    window.location.href="./../prog_create_read.php";
    </script>';

exit();


}

?>