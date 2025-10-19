<?php
include("../../data/conexion.php");

if (isset($_GET['idr'])) {

  $idr = $_GET['idr'];
  $query = "
SELECT rd_servicio.ID_SERV, rd_servicio.*, hruta.h_llegadaorigen, hruta.h_salidaorigen, hruta.t_salidaorigen
FROM rd_servicio INNER JOIN hruta ON rd_servicio.ID_SERV = hruta.id_serv
WHERE (((rd_servicio.ID_SERV)=$idr))";
  $result = mysqli_query($conexion, $query);
$datos=mysqli_fetch_assoc($result);



/*--- REPORTE DIARIO ---*/
$reporte = "
*FECHA*: {$datos['FECHA_SERV']} %0A
*EPS*: {$datos['EPS']} %0A
*PLACA*: {$datos['PLACA']} %0A
*TEMPERATURA*: {$datos['TEMPERATURA']} %0A
*TIPO SERVICIO*: {$datos['TIPO_PROG']} %0A
-----------------------------%0A
*SUPERVISOR*: {$datos['SUPERVISOR']} %0A
*CONDUCTOR*: {$datos['CONDUCTOR']} %0A
*AUXILIAR 1*: {$datos['AUXILIAR1']} %0A
-----------------------------%0A
*EMPRESA*: {$datos['CLIENTE']} %0A
*CUENTA*: {$datos['CUENTA']} %0A
*CLIENTE*: {$datos['CTE_TERCERO']} %0A
*CITA*: {$datos['H_CITA_R']} %0A
-----------------------------%0A
*RESGUARDO*: {$datos['RESGUARDO']} %0A
*DATALOGGER*: {$datos['DATALOGGER']} %0A
*INGRESO A CARGA*: {$datos['h_llegadaorigen']} %0A
*SALIDA DE CARGA*: {$datos['h_salidaorigen']} %0A
";


$titulo = "
*REPORTE DIARIO*:%0A

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
