<?php include("./../../data/conexion.php"); ?>
<?php 

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$cta = $_GET['cta'];
/*
$query="SELECT * FROM  programaciones WHERE id_prog= $id  ";
$result=mysqli_query($conexion, $query);
$filas=mysqli_fetch_assoc($result);
$vh = $filas ['vh_asignado'];
$u1 = $filas ['id_conductor'];
$u2 = $filas ['id_ayudante'];
$query = "UPDATE unidades set 
  vh_ordenes = 'si'
  WHERE id_vh=$vh";
  mysqli_query($conexion, $query);
$query = "UPDATE usuarios set 
  user_disponible = 'si'
  WHERE id_user=$u1";
  mysqli_query($conexion, $query);
$query = "UPDATE usuarios set 
  user_disponible = 'si'
  WHERE id_user=$u2";
  mysqli_query($conexion, $query);
*/

$query0="SELECT * FROM  programaciones WHERE id_prog= $id  ";
$result0=mysqli_query($conexion, $query0);
$filas0=mysqli_fetch_assoc($result0);
$c4  = $filas0 ['vh_asignado'];
$c6 = $filas0 ['id_conductor'];
$c7 = $filas0 ['id_ayudante'];



$query="SELECT * FROM  unidades WHERE id_vh=$c4 ";
      $result=mysqli_query($conexion, $query);
      $filas=mysqli_fetch_assoc($result);
      $vh= $filas ['vh_ordenes'];
      $vho=$vh-1;

$query2="SELECT * FROM  usuarios WHERE id_user=$c6 ";
      $result2=mysqli_query($conexion, $query2);
      $filas2=mysqli_fetch_assoc($result2);
      $usc= $filas2 ['user_ordenes'];
      $usoc=$usc-1;

$query3="SELECT * FROM  usuarios WHERE id_user=$c7 ";
      $result3=mysqli_query($conexion, $query3);
      $filas3=mysqli_fetch_assoc($result3);
      $usa= $filas3 ['user_ordenes'];
      $usoa=$usa-1;

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



/*---query elimina---*/
$query= "DELETE FROM programaciones WHERE id_prog= $id";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);


 
if (!$result) {
	die('Invalid query: ' . mysqli_error());
	}
?>
<meta http-equiv="refresh" content="0;url=./../prog_create_read.php?id=<?php echo $cta ?>" />
<?php 

exit();
}



?>