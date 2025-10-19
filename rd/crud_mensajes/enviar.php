<?php include("./../../panel/data/conexion.php"); ?>

<?php
function generarEnlaceWhatsApp($numero, $mensaje) {
    // Encode the message, maintaining line breaks
    $mensajeCodificado = rawurlencode($mensaje);

    // Replace spaces with the representation URL (%20)
    $mensajeCodificado = str_replace(' ', '%20', $mensajeCodificado);

    // Replace commas with %2C
    $mensajeCodificado = str_replace(',', '%2C', $mensajeCodificado);

    // Replace line breaks with the representation URL (%0A)
    $mensajeCodificado = str_replace('%0D%0A', '%0A', $mensajeCodificado);

    // Formatea el número y el mensaje para ser parte del enlace
    $numeroWhatsApp = str_replace('+', '', $numero);

    // Construye el enlace con la etiqueta <a>
    $enlaceWhatsApp = "https://api.whatsapp.com/send?phone=$numeroWhatsApp&text=$mensajeCodificado";

    return $enlaceWhatsApp;
}

?>


<?php
/*---NEW MENSAJE ---*/

if (isset($_GET['m'])) {
    $ID_TMSJ=$_GET['m'];
    $NNUMERO=$_GET['n'];
    $query= "SELECT * FROM mensajes WHERE ID_MENSAJE= $ID_TMSJ";
    $result=mysqli_query($conexion, $query);
    $filas=mysqli_fetch_assoc($result);
    $MMENSAJE = $filas ['MENSAJE'];
    $link = $filas ['HIPERVINCULO'];

$firma = "

Gracias por confiar en Lavandy!💛


Atentamente,
Equipo Lavandy

🌐 www.lavandy.net";


$mensaje = $MMENSAJE . $firma . $link;
$numero = '51'. $NNUMERO;

$enlaceWhatsApp = generarEnlaceWhatsApp($numero, $mensaje);



    /*---redireccion ---*/
 ?>   
<meta http-equiv="refresh" 
      content="0;url=<?php echo $enlaceWhatsApp ?>" />
<?php 

exit();

}else{


/*---redireccion ---*/
mysqli_close($conexion);    
echo'<script type="text/javascript">
    window.location.href="./../mensajes_read.php";
    </script>';

}



	?>

