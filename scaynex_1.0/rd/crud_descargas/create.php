<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ARTICULOS---*/

if (isset($_POST['guardar'])) {

    $idp = $_POST['idp'];
    $idr = $_POST['idr'];    
 	$pe_cliente = $_POST['pe_cliente'];
 	$desg_direccion = $_POST['desg_direccion'];
	$desg_distrito = $_POST['desg_distrito'];
	$hrcita = $_POST['hrcita'];
	$prioridad= $_POST['prioridad'];
	//$h_entrega = $_POST['h_entrega'];
	//$t_entrega = $_POST['t_entrega'];
	//$h_salida = $_POST['h_salida'];
	$obs_descarga = $_POST['obs_descarga'];
    $user_desg = $_POST['user_desg'];


if ($_POST['hora_cita']===null) {
	$hora_cita = '00:00:00';
} else {
	$hora_cita = $_POST['hora_cita'];
}


	
$query= "INSERT INTO rd_descargas ( 

id_hruta,
pe_cliente,
desg_direccion,
desg_distrito,
hrcita,
hora_cita,
prioridad,
obs_descarga,
user_desg

) VALUES (

'$idr',
'$pe_cliente',
'$desg_direccion',
'$desg_distrito',
'$hrcita',
'$hora_cita',
'$prioridad',
'$obs_descarga',
'$user_desg'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);


/*---secion para msj ---*/

/*---redireccion ---*/



}

?> 

<meta http-equiv="refresh" content="0;url=./../wt_ruta_ruta.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>" /><?php
