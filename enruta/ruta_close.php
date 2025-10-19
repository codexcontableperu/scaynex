
<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
<?php include("../data/conexion.php"); ?>
<?php include('includes/menubar.php'); ?>




<?php

$idp=$_GET['idp'];
$idr=$_GET['idr'];

     $query2="
SELECT hruta.*, hruta.id_ruta
FROM hruta
WHERE (((hruta.id_ruta)=$idr));

                ";
     $result2=mysqli_query($conexion, $query2);
     $filas2=mysqli_fetch_assoc($result2);



if (is_null($filas2 ['t_inicio']) OR ($filas2 ['t_inicio'] == 0)) {$t_inicio=0; } else { $t_inicio=1; };
if (is_null($filas2 ['h_inicio']) OR ($filas2 ['h_inicio'] == 0)) {$h_inicio=0; } else { $h_inicio=1; };
if (is_null($filas2 ['t_salidabase']) OR ($filas2 ['t_salidabase'] == 0)) {$t_salidabase=0; } else { $t_salidabase=1; };
if (is_null($filas2 ['h_salidabase']) OR ($filas2 ['h_salidabase'] == 0)) {$h_salidabase=0; } else { $h_salidabase=1; };
if (is_null($filas2 ['t_llegadaorigen']) OR ($filas2 ['t_llegadaorigen'] == 0)) {$t_llegadaorigen=0; } else { $t_llegadaorigen=1; };
if (is_null($filas2 ['h_llegadaorigen']) OR ($filas2 ['h_llegadaorigen'] == 0)) {$h_llegadaorigen=0; } else { $h_llegadaorigen=1; };
if (is_null($filas2 ['t_iniciocarga']) OR ($filas2 ['t_iniciocarga'] == 0)) {$t_iniciocarga=0; } else { $t_iniciocarga=1; };
if (is_null($filas2 ['h_iniciocarga']) OR ($filas2 ['h_iniciocarga'] == 0)) {$h_iniciocarga=0; } else { $h_iniciocarga=1; };
if (is_null($filas2 ['t_salidaorigen']) OR ($filas2 ['t_salidaorigen'] == 0)) {$t_salidaorigen=0; } else { $t_salidaorigen=1; };
if (is_null($filas2 ['h_salidaorigen']) OR ($filas2 ['h_salidaorigen'] == 0)) {$h_salidaorigen=0; } else { $h_salidaorigen=1; };
if (is_null($filas2 ['t_llegadadestino']) OR ($filas2 ['t_llegadadestino'] == 0)) {$t_llegadadestino=0; } else { $t_llegadadestino=1; };
if (is_null($filas2 ['h_llegadadestino']) OR ($filas2 ['h_llegadadestino'] == 0)) {$h_llegadadestino=0; } else { $h_llegadadestino=1; };
if (is_null($filas2 ['t_iniciodescarga']) OR ($filas2 ['t_iniciodescarga'] == 0)) {$t_iniciodescarga=0; } else { $t_iniciodescarga=1; };
if (is_null($filas2 ['h_iniciodescarga']) OR ($filas2 ['h_iniciodescarga'] == 0)) {$h_iniciodescarga=0; } else { $h_iniciodescarga=1; };
if (is_null($filas2 ['t_retorno']) OR ($filas2 ['t_retorno'] == 0)) {$t_retorno=0; } else { $t_retorno=1; };
if (is_null($filas2 ['h_retorno']) OR ($filas2 ['h_retorno'] == 0)) {$h_retorno=0; } else { $h_retorno=1; };
if (is_null($filas2 ['k_salidabase']) OR ($filas2 ['k_salidabase'] == 0)) {$k_salidabase=0; } else { $k_salidabase=1; };
if (is_null($filas2 ['k_llegadaorigen']) OR ($filas2 ['k_llegadaorigen'] == 0)) {$k_llegadaorigen=0; } else { $k_llegadaorigen=1; };
if (is_null($filas2 ['k_llegadadestino']) OR ($filas2 ['k_llegadadestino'] == 0)) {$k_llegadadestino=0; } else { $k_llegadadestino=1; };
if (is_null($filas2 ['k_retorno']) OR ($filas2 ['k_retorno'] == 0)) {$k_retorno=0; } else { $k_retorno=1; };

  $rclose=

$t_inicio+
$h_inicio+
$t_salidabase+
$h_salidabase+
$t_llegadaorigen+
$h_llegadaorigen+
$t_iniciocarga+
$h_iniciocarga+
$t_salidaorigen+
$h_salidaorigen+
$t_llegadadestino+
$h_llegadadestino+
$t_iniciodescarga+
$h_iniciodescarga+
$t_retorno+
$h_retorno+
$k_salidabase+
$k_llegadaorigen+
$k_llegadadestino+
$k_retorno;




     $queryg="
     SELECT programaciones.id_prog, Count(guias_remitente.id_guiar) AS CuentaDeid_guiar
FROM programaciones LEFT JOIN guias_remitente ON programaciones.id_prog = guias_remitente.id_prog
GROUP BY programaciones.id_prog
HAVING (((programaciones.id_prog)=$idp));

                ";
     $resultg=mysqli_query($conexion, $queryg);
     $filasg=mysqli_fetch_assoc($resultg);


     $querygt="
     SELECT programaciones.id_prog, programaciones.serie_guiatrans, programaciones.num_guiatrans, programaciones.id_estado
FROM programaciones
WHERE (((programaciones.id_prog)=$idp));
                ";
     $resultgt=mysqli_query($conexion, $querygt);
     $filasgt=mysqli_fetch_assoc($resultgt);



$guiar = $filasg ['CuentaDeid_guiar'];


if (is_null($filasgt ['serie_guiatrans'])) {

  $serie=0
} else {
  $serie=1
}

if (is_null($filasgt ['num_guiatrans'])) {

  $numero=0
} else {
  $numero=1
}








if ($guiar == 0 and $serie == 0 and $numero == 0) {
  $idp=$_GET['idp'];
   $query0 = "UPDATE programaciones set 
  id_estado   = 1
  WHERE id_prog=$idp";
  mysqli_query($conexion, $query0);
} else {
  $idp=$_GET['idp'];
   $query0 = "UPDATE programaciones set 
  id_estado   = 0
  WHERE id_prog=$idp";
  mysqli_query($conexion, $query0);
}




if ($rclose == 20 and $estado==0) {
 ?>


<br><br><br><br>
   <div class="container text-center">
  <div class="row">

    <div class="col-sm">

<div class="card">
  <div class="card-header">
    <?php echo $rclose?> CIERRE DE RUTA
  </div>
  <div class="card-body">
    <h5 class="card-title"> PROCESO DE CIERRE DE RUTA</h5>
    <p class="card-text">Inicia proceso de  cierre.</p>
    <a href="crud_ruta/update4.php?idp=<?php echo $filas2 ['id_prog']?>&idr=<?php echo $filas2 ['id_ruta']?>" class="btn btn-danger">CERRAR</a>
  </div>
</div>

    </div>
  </div>
</div>

<?php }

 else {  
$idp=$_GET['idp'];
$idr=$_GET['idr']; 
?>


<br><br><br><br>
   <div class="container text-center">
  <div class="row">

    <div class="col-sm">

<div class="card">
  <div class="card-header">
    <?php echo $rclose?> CIERRE DE RUTA
    <?php $reg = 20- $rclose?>
  </div>
  <div class="card-body">
    <h5 class="card-title">  LA HOJA DE RUTA NO ESTA COMPLETA</h5>
    <p class="card-text">Complete los datos de la hoja de ruta para poder cerrar.</p> <br><br>

    <div class="text-left">
    <p> Status: </p>
    <li> Falta <?php echo $reg?> Registros de la hoja de ruta</li>
    <li> Estan regitrado <?php echo $guiar?> guias de remision</li>
    <?php if (is_null($filasgt ['serie_guiatrans'])) { $guiat=0;} else { $guiat=1;}?>
    <li> Estan regitrado <?php echo $guiat?> guias de transportista</li>



    </div>
<br><br>

    <a href="ruta_create_read.php?idp=<?php echo $filas2 ['id_prog']?>&idr=<?php echo $filas2 ['id_ruta']?>" class="btn btn-danger">REGRESAR</a>
  </div>
</div>

    </div>
  </div>
</div>

<?php }


?>


<?php include('includes/footer.php'); ?>


