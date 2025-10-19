<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ARTICULOS---*/

if (isset($_POST['guardar'])) {


	$c2 = $_POST['ruc'];
	$c3 = $_POST['empresa'];

$idp = $_POST['idp'];
$idr = $_POST['idr'];

$query= "INSERT INTO emp_destino(  
ruc, 
emp_destino 
) VALUES (
'$c2',
'$c3'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);


/*---secion para msj ---*/

/*---redireccion ---*/



}

?>

<meta http-equiv="refresh" content="0;url=./../guiasrem_create_read.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>" />

