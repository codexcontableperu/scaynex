<?php include("./../../data/conexion.php"); ?>

<?php



if (isset($_GET['idp'])) {



$idp=$_GET['idp'];
$idr=$_GET['idr'];



/// actualisa tabla

  $query = "UPDATE hruta set 
  estado_hr  = 1
  WHERE id_ruta=$idr";
  mysqli_query($conexion, $query);





     $query2="
  SELECT programaciones.id_prog, Count(hruta.estado_hr) AS CuentaDeestado_hr, Sum(hruta.estado_hr) AS SumaDeestado_hr
FROM programaciones INNER JOIN hruta ON programaciones.id_prog = hruta.id_prog
GROUP BY programaciones.id_prog
HAVING (((programaciones.id_prog)=$idp));

                ";
     $result2=mysqli_query($conexion, $query2);
     $filas2=mysqli_fetch_assoc($result2);

  $suma = $filas2 ['SumaDeestado_hr'];
  $cuenta = $filas2 ['CuentaDeestado_hr'];


if ($suma == $cuenta) {
  $idp=$_GET['idp'];
   $query0 = "UPDATE programaciones set 
  id_estado   = 0
  WHERE id_prog=$idp";
  mysqli_query($conexion, $query0);
} else {
  $idp=$_GET['idp'];
   $query0 = "UPDATE programaciones set 
  id_estado   = 1
  WHERE id_prog=$idp";
  mysqli_query($conexion, $query0);
}








?><meta http-equiv="refresh" content="0;url=./../ruta_nuevo.php?idp=<?php echo $idp ?>" /><?php
}

?>

