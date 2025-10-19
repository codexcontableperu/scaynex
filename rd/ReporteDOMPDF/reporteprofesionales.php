<?php ob_start(); ?>
<h2>Reporte de Profesionales</h2>
 <br>  


<table width="500px" cellpadding="5px" cellspacing="5px" border="1">
    <tr bgcolor="#00FF00">
        <td>Nombre</td>
        <td>Apellido</td>
        <td>Email</td>
        <td>Carrera</td>
        <td>Especialidad</td>
    </tr>
    <tr >
        <td>angel Luis</td>
        <td>albinagorta </td>
        <td>albinagorta1998@gmail.com</td>
        <td>Ing. Sistemas</td>
        <td>Desarrollor de Software</td>
    </tr>
    <tr >
        <td>Alcides</td>
        <td>Camana</td>
        <td>Camana@gmail.com</td>
        <td>Ing. Sistemas</td>
        <td>Analista de Software</td>
    </tr>
    <tr>
        <td>judiht</td>
        <td>Mayta</td>
        <td>mayta@gmail.com</td>
        <td>Ing. Sistemas</td>
        <td>Desarrollor de Software</td>
    </tr>
    <tr>
        <td>Milagros</td>
        <td>Almerco</td>
        <td>almerca@gmail.com</td>
        <td>Ing. Sistemas</td>
        <td>Desarrollor de Software</td>
    </tr>       
    <tr>
        <td>Victor</td>
        <td>Zurita</td>
        <td>zuritav@gmail.com</td>
        <td>Negocios Internacionales</td>
        <td>Negocios Internacionales</td>
    </tr>
  
</table>
<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "profesionales.pdf";
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>
