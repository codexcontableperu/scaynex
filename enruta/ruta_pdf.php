<?php
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf

use Dompdf\Dompdf;
include_once 'dompdf/autoload.inc.php';
// Introducimos HTML de prueba


// $html=file_get_contents_curl("https://localhost/planner/enruta/pdfrep.php");


 
// Instanciamos un objeto de la clase DOMPDF.
$pdf = new Dompdf();

$idr=$_GET['idr'];
$idp=$_GET['idp'];

$html=file_get_contents("http://localhost/planner/enruta/ruta_print.php?idr=".$_GET['idr']."&idp=".$_GET['idp']);




// contenido
$pdf->loadHtml(utf8_decode($html));

 
// Definimos el tamaño y orientación del papel que queremos.
//$pdf->set_paper("A4", "portrait");


//$dompdf->setPaper('A5', 'portrait');
 
//tamaño custom, se especifica en puntos, lo que en CSS se escribe como pt
$pdf->set_paper(array(0, 0, 595, 841), 'portrait');



//$pdf->set_paper(array(0,0,104,250));
 
// Cargamos el contenido HTML.
//$pdf->load_html(utf8_decode($html));
 
// Renderizamos el documento PDF.
$pdf->render();
 
// Enviamos el fichero PDF al navegador.
$pdf->stream('ruta.php');

?>