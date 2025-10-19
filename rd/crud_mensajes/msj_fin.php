<?php
include("../../data/conexion.php");

if (isset($_GET['idp'])) {

  $idp = $_GET['idp'];
  $query = "SELECT rd_inicio_fin.*, rd_segimientos_head.S_FECHA, rd_segimientos_head.PLACA
FROM rd_inicio_fin INNER JOIN rd_segimientos_head ON rd_inicio_fin.Id_SERG = rd_segimientos_head.Id_SERG
WHERE (((rd_segimientos_head.Id_SERG)=$idp))";
  $result = mysqli_query($conexion, $query);
$filas=mysqli_fetch_assoc($result);


/*--- NEW MENSAJE ---*/
$reporte = "
00{$filas['Id_SERG']} %0A
*FECHA*: {$filas['S_FECHA']} %0A
*PLACA*: {$filas['PLACA']} %0A
*HORA*: {$filas['HORA_LLEGADA_BASE']} %0A
*KILOMETRAJE*: {$filas['KM_LLEGADA_BASE']} %0A
*TEMPERATURA*: {$filas['TEMP_LLEGADA_BASE']} %0A
";

$titulo = "
*REPORTE LLEGADA-BASE*:%0A

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
