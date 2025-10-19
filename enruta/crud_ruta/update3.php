<?php include("./../../data/conexion.php"); ?>

<?php



if (isset($_POST['idp'])) {



$idp=$_POST['idp'];
$idr=$_POST['idr'];

  $c11 = $_POST['serie_guiatrans'];
  $c12 = $_POST['num_guiatrans'];


/// actualisa tabla

  $query = "UPDATE programaciones set 
  serie_guiatrans = '$c11',
  num_guiatrans = '$c12'
  WHERE id_prog=$idp";
  mysqli_query($conexion, $query);


?><meta http-equiv="refresh" content="0;url=./../ruta_create_read.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>" /><?php

}

?>


