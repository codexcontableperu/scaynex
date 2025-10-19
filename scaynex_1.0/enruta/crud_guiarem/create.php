<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ARTICULOS---*/

if (isset($_POST['guardar'])) {


	$c2 = $_POST['idp'];
	$c3 = $_POST['idr'];
	$c4 = $_POST['origen_distrito'];
	$c5= $_POST['gr_serienum'];
	$c6 = $_POST['emp_destino'];
	$c7 = $_POST['destino_distrito'];
	$c8 = $_POST['fact_cliente'];
	$c9 = $_POST['gr_bultos'];
	$c10 = $_POST['gr_obs'];

	
$query= "INSERT INTO guias_remitente( 

id_prog,
id_ruta,
origen_distrito,
gr_serienum,
emp_destino,
destino_distrito,
fact_cliente,
gr_bultos,
gr_obs

) VALUES (

'$c2',
'$c3',
'$c4',
'$c5',
'$c6',
'$c7',
'$c8',
'$c9',
'$c10'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);


/*---secion para msj ---*/

/*---redireccion ---*/



}

?> <meta http-equiv="refresh" content="0;url=./../guiasrem_create_read.php?idp=<?php echo $c2 ?>&idr=<?php echo $c3 ?>" /><?php

?>

<meta http-equiv="refresh" content="0;url=./../guiasrem_create_read.php?idp=<?php echo $c2 ?>&idr=<?php echo $c3 ?>" />