<?php include('includes/session1.php'); ?>
<?php include("../data/conexion.php"); ?>
<!DOCTYPE html><html style="font-size: 16px;">
<!-- Mirrored from website726460.nicepage.io/es/Contact.html?version=c99f6d58-dbb4-4080-9506-a3a93b2be7f2 by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Feb 2024 16:54:43 GMT -->
<head>
            <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css"> 

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Subscribe Now">
    <meta name="description" content>
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>App-Scaynex</title>
    <link rel="stylesheet" href="stylos/nicepage6168.css?version=6a9bdefb-4bc9-4812-9536-5d51bd2eb046" media="screen">
    <script class="u-script" type="text/javascript" src="js_login/jquery-1.9.1.min.js" defer></script>
    <script class="u-script" type="text/javascript" src="js_login/nicepage.js" defer></script>
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata:400">
    <link rel="stylesheet" href="stylos/mimenu.css" media="screen">


<?php include('includes/ffecha.php'); ?>   

    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Contact">
    <meta property="og:type" content="website">
    <link rel="stylesheet" href="style.css">

</head>
  <body class="u-body">

<?php include('includes/headerPan.php'); ?>

















<section class=" u-align-center u-clearfix u-image u-section-2" id="carousel_527b" data-image-width="1980" data-image-height="1114">
       
  <div  class="u-clearfix u-sheet u-valign-middle u-sheet-1">


<?php
// Verificar la conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

$sql = "SELECT Id_SERG, CONDUCTOR, ID_CLIENTE, S_FECHA, PLACA, AUXILIAR1, AUXILIAR2, AUXILIAR3, ESTADO_IDP 
        FROM rd_segimientos_head 
        WHERE ESTADO_IDP = 0";

$result = mysqli_query($conexion, $sql);

$nueva_tabla = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Añadir filas para cada operador
        $nueva_tabla[] = array("TIPO_OPERADOR" => "CONDUCTOR", "NOMBRE" => $row["CONDUCTOR"], "Id_SERG" => $row["Id_SERG"], "ESTADO_IDP" => $row["ESTADO_IDP"], "ID_CLIENTE" => $row["ID_CLIENTE"], "S_FECHA" => $row["S_FECHA"], "PLACA" => $row["PLACA"]);
        $nueva_tabla[] = array("TIPO_OPERADOR" => "AUXILIAR1", "NOMBRE" => $row["AUXILIAR1"], "Id_SERG" => $row["Id_SERG"], "ESTADO_IDP" => $row["ESTADO_IDP"], "ID_CLIENTE" => $row["ID_CLIENTE"], "S_FECHA" => $row["S_FECHA"], "PLACA" => $row["PLACA"]);
        $nueva_tabla[] = array("TIPO_OPERADOR" => "AUXILIAR2", "NOMBRE" => $row["AUXILIAR2"], "Id_SERG" => $row["Id_SERG"], "ESTADO_IDP" => $row["ESTADO_IDP"], "ID_CLIENTE" => $row["ID_CLIENTE"], "S_FECHA" => $row["S_FECHA"], "PLACA" => $row["PLACA"]);
        $nueva_tabla[] = array("TIPO_OPERADOR" => "AUXILIAR3", "NOMBRE" => $row["AUXILIAR3"], "Id_SERG" => $row["Id_SERG"], "ESTADO_IDP" => $row["ESTADO_IDP"], "ID_CLIENTE" => $row["ID_CLIENTE"], "S_FECHA" => $row["S_FECHA"], "PLACA" => $row["PLACA"]);
    }
} else {
    echo "0 resultados";
}

// Cerrar la conexión
mysqli_close($conexion);


// Filtrar la nueva tabla por el nombre específico
//$nombre_buscado = "CRIS RA";

$nombre_buscado = $userup ;
$resultado = array_filter($nueva_tabla, function($fila) use ($nombre_buscado) {
    return $fila["NOMBRE"] === $nombre_buscado;
});

// Imprimir el resultado filtrado
// foreach ($resultado as $fila) {
   //  echo "TIPO DE OPERADOR: {$fila['TIPO DE OPERADOR']} - NOMBRE: {$fila['NOMBRE']} - Id_SERG: {$fila['Id_SERG']} - ESTADO_IDP: {$fila['ESTADO_IDP']} - ID_CLIENTE: {$fila['ID_CLIENTE']} - S_FECHA: {$fila['S_FECHA']} - PLACA: {$fila['PLACA']}<br>";
// }


?>




<br>
<style>
.titu {

  align-items: center;
  text-align: center;
}




</style>

<div class="titu" >
  <h5>Programaciones Activas</h5>

</div>

<br>


<div class="botones">
  <div class="container text-center">
    <div class="row d-flex justify-content-center"> <!-- d-flex y justify-content-center para alinear en línea -->
      <?php foreach ($resultado as $filaso) { ?>
        <a class="btn btn-lg btn-dark square-btn mx-2" style="color: white;" href="wt_panel_user.php?idp=<?php echo $filaso['Id_SERG']?>">
          <span class="icon-truck"></span><br>
          <span style="font-size: 13px;"><?php echo $filaso['TIPO_OPERADOR']?></span><br>
          <?php echo $filaso['PLACA']?><br>
          <span style="font-size: 13px;"><?php echo $filaso['ID_CLIENTE']?></span><br>
          <span style="font-size: 13px;"><?php echo $filaso['S_FECHA']?></span>
          
        </a>
      <?php } ?>
    </div>
  </div>
</div>


  </div> 
</section>








    
<footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-53ac"><div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">

        </p>
      </div></footer>
    <section class="u-backlink u-clearfix u-grey-80">
      <a class="u-link" href="https://nicepage.com/website-templates" target="_blank">
        <span>  Aplicativo web - whatsaap</span>
      </a>
      <p class="u-text">
        <span> - </span>
      </p>
      <a class="u-link" href="https://nicepage.com/" target="_blank">
        <span>Website codex</span>
      </a>. 
    </section>

        





  



  
</body>

</html>