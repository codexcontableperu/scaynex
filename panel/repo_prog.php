<?php ob_start(); ?>
<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>

<?php
if (isset($_POST['f'])) {
  $fecha = $_POST['f'];
} else {
  $fecha = $_GET['f'];
}
$_SESSION['fechaw'] = $fecha;
$FECHAW = $_SESSION['fechaw'];

$originalDate = $fecha;
setlocale(LC_TIME, 'es_ES.UTF-8');
// Usar IntlDateFormatter para obtener la fecha en español
$fmt = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
$fmt->setPattern('EEEE d ' . "'de'" . ' MMMM ' . "'de'" . ' yyyy');
$newDate = $fmt->format(new DateTime($originalDate));
?>

<B><h6>
  # UNIDADES PROGRAMADAS: <?php echo mb_convert_encoding($newDate, 'UTF-8', 'ISO-8859-1') ?>
</B></h6>

<div class="dropdown-divider"></div> 

<style type="text/css">
  .TBOY {
    text-align: left;
  }
  .plac {
    font-size: 10px; /* Tamaño de fuente ajustado a 10px */
  }
  table {
    width: 100%;
    border-collapse: collapse;
  }
  th, td {
    border: 1px solid #ddd;
    padding: 8px;
    font-size: 10px; /* Tamaño de fuente ajustado a 10px */
  }
  th {
    background-color: #f2f2f2;
    text-align: center;
  }
  tr:nth-child(even) {
    background-color: #f9f9f9;
  }
  tr:hover {
    background-color: #ddd;
  }
</style>

<?php 
$query6 = "
SELECT rd_segimientos_head.*, rd_segimientos_head.S_FECHA, rd_segimientos_head.Id_SERG
FROM rd_segimientos_head
WHERE rd_segimientos_head.S_FECHA = '" . mysqli_real_escape_string($conexion, $fecha) . "'
ORDER BY rd_segimientos_head.Id_SERG DESC;
";
$result6 = mysqli_query($conexion, $query6);
?>

<table class="table table-sm table-striped plac">
  <thead class="thead-dark">
    <tr>
      <th>#</th>
      <th>PLACA</th>
      <th>CONDUCTOR</th>
      <th>AUXILIARES</th>
      <th>HORA</th>
      <th>ALCANCE</th>
    </tr>
  </thead>
  <tbody class="TBOY">
    <?php 
    $count = 1;
    while($filas6 = mysqli_fetch_assoc($result6)) { ?>
    <tr>
      <th><?php echo $count++; ?></th>
      <th scope="row"> <?php echo $filas6['PLACA'] ?><br> 
        <?php echo $filas6['TEMPERATURA'] ?>
      </th>
      <td><?php echo $filas6['CONDUCTOR'] ?></td>
      <td>AUX1: <?php echo $filas6['AUXILIAR1'] ?><br>
        AUX2: <?php echo $filas6['AUXILIAR2'] ?><br>
        AUX3: <?php echo $filas6['AUXILIAR3'] ?>
      </td>
      <td>H CITA: <?php echo $filas6['H_CITA'] ?><br>
          H BASE: <?php echo $filas6['H_CITA_R'] ?>
      </td>      
      <td>
        SERV: <?php echo $filas6['ID_CLIENTE'] ?> / 
        <?php echo $filas6['SERVICIOS'] ?> / 
        <?php echo $filas6['TIPO_DESPACHO'] ?>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<?php
$tablaa = ob_get_clean();
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHTML($tablaa);
$dompdf->setPaper('letter', 'landscape'); // Configuración para mostrar en horizontal

$dompdf->render();
$dompdf->stream("reporte1.pdf", array('Attachment' => false));
?>

<?php include('includes/footer.php'); ?>
