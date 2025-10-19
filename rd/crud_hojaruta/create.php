<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ARTICULOS---*/

if (isset($_GET['idr'])) {

$idr = $_GET['idr'];

$queryh="
SELECT hruta.id_serv, rd_segimientos_head.S_FECHA, hruta.h_llegadaorigen, guias_remitente.gr_serienum, guias_remitente.fact_cliente, guias_remitente.gr_bultos, rd_descargas.pe_cliente, rd_descargas.desg_distrito, rd_descargas.hrcita, rd_descargas.prioridad, hruta.h_salidaorigen, hruta.h_llegadadestino, rd_descargas.h_entrega, rd_descargas.t_entrega, rd_descargas.h_salida, rd_descargas.t_recepcion, rd_descargas.obs_descarga, hruta.id_ruta
FROM (guias_remitente INNER JOIN rd_descargas ON guias_remitente.id_desg = rd_descargas.id_descaga) INNER JOIN ((hruta INNER JOIN rd_servicio ON hruta.id_serv = rd_servicio.ID_SERV) INNER JOIN rd_segimientos_head ON hruta.id_prog = rd_segimientos_head.Id_SERG) ON rd_descargas.id_hruta = hruta.id_serv
WHERE (((hruta.id_serv)=$idr));


";
$resulth=mysqli_query($conexion, $queryh);

while($filash=mysqli_fetch_assoc($resulth)) {

  $user = $_POST['id_user'];
  $ID_SERG = $_POST['Id_SERG'];
  $HBASE = $_POST['H_BASE'];
  $glosa = 'OTR ' . $ID_SERG . "- " . $HBASE;


$query= "INSERT INTO hruta(  
ruta_glosa, 
id_user, 
id_prog 
) VALUES (
'$glosa',
'$user',
'$ID_SERG'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);

 }
}

?>


<meta http-equiv="refresh" 
      content="0;url=./../wt_panel_user.php?id=<?php echo $ID_SERG ?>" />