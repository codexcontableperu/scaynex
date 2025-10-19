<?php ob_start(); ?>
<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>

 
<?php

if (isset($_POST['f'])) {
  $fecha = $_POST['f'];
$_SESSION['fechaw']=$fecha;
$FECHAW=$_SESSION['fechaw'];
} else  {
  $fecha = $_GET['f'];
$_SESSION['fechaw']=$fecha;
$FECHAW=$_SESSION['fechaw'];
}
$originalDate = $fecha;
setlocale(LC_TIME, 'spanish');
$newDate = strftime("%A %d de %B %Y", strtotime($originalDate));
?>


  <B><h6>
    # UNIDADES PROGRAMADAS : <?php echo utf8_encode($newDate) ?>
    </B></h6>

<div class="dropdown-divider"></div> 


<style type="text/css">
  .TBOY{
    text-align: left;

  }
  .plac{
    font-size: 11px;
  }
</style>

<?php 
$query6="
SELECT rd_segimientos_head.*, rd_segimientos_head.S_FECHA, rd_segimientos_head.Id_SERG
FROM rd_segimientos_head
WHERE (((rd_segimientos_head.S_FECHA)='$fecha'))
ORDER BY rd_segimientos_head.Id_SERG DESC;
";
$result6=mysqli_query($conexion, $query6);


 ?>

 

<table  class="table table-sm table-striped plac">
    <thead class="thead-dark">
        <tr>
            <th>CONDUCTOR</th>
            <th>AUXILIARES</th>
            <th>ALCANCE</th>
        </tr>
    </thead>
  <tbody class="TBOY">
    <?php while($filas6=mysqli_fetch_assoc($result6)) { ?>
    <tr>
      <th scope="row" > PLACA: <?php echo $filas6 ['PLACA']  ?> <br>
        CDR: <?php echo $filas6 ['CONDUCTOR']  ?>
      </th>
      <td>AUX1: <?php echo $filas6 ['AUXILIAR1']  ?><br>
        AUX2: <?php echo $filas6 ['AUXILIAR2']  ?><br>
        AUX3: <?php echo $filas6 ['AUXILIAR3']  ?>
      </td>
      <td>CITA: <?php echo $filas6 ['H_CITA']  ?><br>
        SERV: <?php echo $filas6 ['ID_CLIENTE']  ?> / 
        <?php echo $filas6 ['SERVICIOS']  ?>

      </td>
    </tr>


   
    <?php } ?>
  </tbody>
</table>
<?php
$tablaa=ob_get_clean();
//echo $tablaa;
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled'=> true));
$dompdf->setOptions($options);

$dompdf->loadHTML($tablaa);
$dompdf->setPaper('letter');
//$dompdf->setPaper('A4','landscape');

$dompdf->render();
$dompdf->stream("reporte1.pdf", array('Attachment'=> False));
?>


<?php include('includes/footer.php'); ?>

