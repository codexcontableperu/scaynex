<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ARTICULOS---*/

if (isset($_POST['guardar'])) {


	$c2 = $_POST['id_user'];
	$c3 = $_POST['id_prog'];
	$c4 = $_POST['cta_nombrecomercial'];
	$glosa = 'OTR ' . $c3 . "- " . $c4;



$query= "INSERT INTO hruta(  
ruta_glosa, 
id_user, 
id_prog 
) VALUES (
'$glosa',
'$c2',
'$c3'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);




/*---cambio de estado de programaciones ---*/

     $query2="
  SELECT programaciones.id_prog, Count(hruta.estado_hr) AS CuentaDeestado_hr, Sum(hruta.estado_hr) AS SumaDeestado_hr
FROM programaciones INNER JOIN hruta ON programaciones.id_prog = hruta.id_prog
GROUP BY programaciones.id_prog
HAVING (((programaciones.id_prog)=$c3));

                ";
     $result2=mysqli_query($conexion, $query2);
     $filas2=mysqli_fetch_assoc($result2);

  $suma = $filas2 ['SumaDeestado_hr'];
  $cuenta = $filas2 ['CuentaDeestado_hr'];


if ($suma == $cuenta) {
  $idp=$_POST['id_prog'];
   $query0 = "UPDATE programaciones set 
  id_estado   = 0
  WHERE id_prog=$idp";
  mysqli_query($conexion, $query0);
} else {
  $idp=$_POST['id_prog'];
   $query0 = "UPDATE programaciones set 
  id_estado   = 1
  WHERE id_prog=$idp";
  mysqli_query($conexion, $query0);
}


}

?>

<meta http-equiv="refresh" content="0;url=./../ruta_nuevo.php?idp=<?php echo $c3 ?>" />