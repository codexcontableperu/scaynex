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


/*---secion para msj ---*/

/*---redireccion ---*/



}

?>

<meta http-equiv="refresh" content="0;url=./../ruta_nuevo.php?idp=<?php echo $c3 ?>" />