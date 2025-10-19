<?php include("./../../data/conexion.php"); ?>



<?php 

/*---NEW ARTICULOS---*/

if (isset($_POST['guardar'])) {


	$c2 = $_POST['id_head'];
	$c3 = $_POST['id_cta'];
	$c4 = $_POST['vh_asignado'];

if ($_POST['vh_reportado'] =='') {
	$c5 = $c4; 
} else {
	$c5 = $_POST['vh_reportado'];

} 

	
	$c6 = $_POST['id_conductor'];
	$c7 = $_POST['id_ayudante'];
	$c8 = $_POST['cant_estiva'];
	$c9 = $_POST['id_tprog'];
	$c10 = $_POST['id_estado'];
	$c13 = $_POST['obs_prog'];
  $c14 = $_POST['id_habilidad'];
 

$query= "INSERT INTO programaciones(  
id_head,  
id_cta,
vh_asignado,
vh_reportado,
id_conductor,
id_ayudante,
cant_estiva,
id_tprog,
id_estado,
obs_prog,
id_habilidad
) VALUES (
'$c2',
'$c3',
'$c4',
'$c5',
'$c6',
'$c7',
'$c8',
'$c9',
'$c10',
'$c13',
'$c14'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);

$query="SELECT * FROM  unidades WHERE id_vh=$c4 ";
      $result=mysqli_query($conexion, $query);
			$filas=mysqli_fetch_assoc($result);
			$vh= $filas ['vh_ordenes'];
			$vho=$vh+1;

$query2="SELECT * FROM  usuarios WHERE id_user=$c6 ";
      $result2=mysqli_query($conexion, $query2);
			$filas2=mysqli_fetch_assoc($result2);
			$usc= $filas2 ['user_ordenes'];
			$usoc=$usc+1;

$query3="SELECT * FROM  usuarios WHERE id_user=$c7 ";
      $result3=mysqli_query($conexion, $query3);
			$filas3=mysqli_fetch_assoc($result3);
			$usa= $filas3 ['user_ordenes'];
			$usoa=$usa+1;

$query = "UPDATE unidades set 
  vh_ordenes = $vho
  WHERE id_vh=$c4";
  mysqli_query($conexion, $query);

$query = "UPDATE usuarios set 
  user_ordenes = $usoc
  WHERE id_user=$c6";
  mysqli_query($conexion, $query);

$query = "UPDATE usuarios set 
  user_ordenes = $usoa
  WHERE id_user=$c7";
  mysqli_query($conexion, $query);

/*

$query = "UPDATE unidades set 
  vh_disponible = 'no'
  WHERE id_vh=$c4";
  mysqli_query($conexion, $query);

$query = "UPDATE usuarios set 
  user_disponible = 'no'
  WHERE id_user=$c6";
  mysqli_query($conexion, $query);

$query = "UPDATE usuarios set 
  user_disponible = 'no'
  WHERE id_user=$c7";
  mysqli_query($conexion, $query);


*/

}

?>





<meta http-equiv="refresh" content="0;url=./../prog_create_read.php?id=<?php echo $c2 ?>" />


