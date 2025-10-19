<?php
include("../../data/conexion.php");

if (isset($_GET['idd'])) {

  $idd = $_GET['idd'];
  $query = "SELECT rd_descargas.t_espera, rd_descargas.t_recepcion, rd_descargas.obs_descarga, rd_descargas.pe_cliente, rd_descargas.desg_distrito, rd_descargas.h_entrega, rd_descargas.h_salida, Sum(guias_remitente.gr_bultos) AS SumaDegr_bultos, rd_descargas.id_descaga
FROM guias_remitente INNER JOIN rd_descargas ON guias_remitente.id_desg = rd_descargas.id_descaga
GROUP BY rd_descargas.pe_cliente, rd_descargas.desg_distrito, rd_descargas.h_entrega, rd_descargas.h_salida, rd_descargas.id_descaga
HAVING (((rd_descargas.id_descaga)=$idd));";
  $result = mysqli_query($conexion, $query);
$filas=mysqli_fetch_assoc($result);



/*--- NEW MENSAJE ---*/
$reporte = "
------------------------%0A
*ID*: 00{$filas['id_descaga']} %0A
*Cliente*: {$filas['pe_cliente']} %0A
*Distrito*: {$filas['desg_distrito']} %0A
*Bultos*: {$filas['SumaDegr_bultos']} %0A
*Hora*: {$filas['h_salida']} %0A
*Espera*: {$filas['t_espera']} %0A
*Recepcion*: {$filas['t_recepcion']} %0A
*Observacion*: {$filas['obs_descarga']} %0A
------------------------%0A
";

$titulo = "
*REPORTE DESCARGA*:%0A

";



$mensaje = $titulo . $reporte ;

//echo $mensaje;
//die();
    /*---redireccion ---*/
 ?>   
<meta http-equiv="refresh" 
      content="0;url=https://wa.me/?text=<?php echo $mensaje ?>" />
<?php 





}
?>
