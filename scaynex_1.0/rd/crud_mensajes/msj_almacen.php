<?php
include("../../data/conexion.php");

if (isset($_GET['idr'])) {



  $idr = $_GET['idr'];
  $query = "
SELECT hruta.id_serv, hruta.h_llegadaorigen, hruta.h_salidaorigen, hruta.t_salidaorigen, rd_servicio.FECHA_SERV, rd_servicio.PLACA, rd_servicio.NBULTOS, rd_servicio.PALETAS, rd_servicio.EPS
FROM hruta INNER JOIN rd_servicio ON hruta.id_serv = rd_servicio.ID_SERV
WHERE (((hruta.id_serv)=$idr))";

  $result = mysqli_query($conexion, $query);
$datos=mysqli_fetch_assoc($result);


/*--- REPORTE DIARIO ---*/
$reporte = "
-----------------------------%0A
*FECHA*: {$datos['FECHA_SERV']} %0A
*EPS*: {$datos['EPS']} %0A
*PLACA*: {$datos['PLACA']} %0A
-----------------------------%0A
*HORA INGRESO*: {$datos['h_llegadaorigen']} %0A
*HORA SALIDA*: {$datos['h_salidaorigen']} %0A
*TEMPERATURA*: {$datos['t_salidaorigen']} %0A
-----------------------------%0A
*PALETAS*: {$datos['PALETAS']} %0A
*BULTOS*: {$datos['NBULTOS']} %0A
-----------------------------%0A
";


$titulo = "
*SALIDA DE ALMACEEN*:%0A

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
