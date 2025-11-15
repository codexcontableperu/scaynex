<?php include("./../../data/conexion.php"); ?>
          <?php 
          $timestamp = new DateTime(null, new DateTimeZone('America/Lima'));
          $fehra = $timestamp->format('d-m-y H:i:s');

          ?>
<?php 

/*---NEW ARTICULOS---*/

if (isset($_POST['idp'])) {

$idp = $_POST['idp'];
$HF = $fehra ;
    $latitud = $_POST["latitud"];
    $longitud = $_POST["longitud"];

// Actualizar la tabla

  $query = "UPDATE rd_inicio_fin set

H_FINAL_SERV = '$HF',
f_latitud = '$latitud',
f_longitud = '$longitud'


  WHERE Id_SERG=$idp";
mysqli_query($conexion, $query);


$query = "UPDATE rd_segimientos_head SET
         
        ESTADO_IDP = 4,
        PENDIENTE = 2
    WHERE Id_SERG = $idp";

    mysqli_query($conexion, $query);

    mysqli_close($conexion);


}

?> 

<meta http-equiv="refresh" content="0;url=./../wt_panel_user.php?idp=<?php echo $idp ?>" />


