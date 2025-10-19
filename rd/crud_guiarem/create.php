<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ARTICULOS---*/

if (isset($_POST['guardar'])) {
$idd = $_POST['idd'];
$idp = $_POST['idp'];
$idr= $_POST['idr'];

    $gr_serienum = $_POST['guias'];
    $fact_cliente = $_POST['factura'];
 	$gr_bultos = $_POST['bustos'];
	$gr_obs = $_POST['gr_obs'];
	
	
	
	
$query= "INSERT INTO guias_remitente ( 

id_desg,
id_prog,
id_ruta,
gr_serienum,
fact_cliente,
gr_bultos,
gr_obs

) VALUES (

'$idd',
'$idp',
'$idr',
'$gr_serienum',
'$fact_cliente',
'$gr_bultos',
'$gr_obs'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);


                   $query = "UPDATE rd_descargas set desg_grem = 'SI' WHERE id_descaga ='$idd'"; mysqli_query($conexion, $query);



}

?> 

<meta http-equiv="refresh" content="0;url=./../wt_ruta_descargas.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>&idd=<?php echo $idd ?>" /><?php
