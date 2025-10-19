<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>
<?php include('whatsaap.php'); ?>
<link rel="stylesheet" href="style.css">
          <?php 
          $timestamp = new DateTime(null, new DateTimeZone('America/Lima'));
          $hoy = $timestamp->format('y-m-d');
          $horaa = $timestamp->format('H:i:s');
          $hoyfor = $timestamp->format('d-m-y');

          ?>
    <link rel="stylesheet" href="whatsaap/stilo_pag.css">

    <div class="pagina-centrada">
        <!-- Contenido de la página aquí -->

<?php 

$ID=$_GET['id'];

$query="

SELECT rd_inicio_fin.*, rd_inicio_fin.Id_SERG
FROM rd_inicio_fin
WHERE (((rd_inicio_fin.Id_SERG)='$ID'));

";
$result=mysqli_query($conexion, $query);
$numfilas = mysqli_num_rows($result);

if ($numfilas>0) {
$filas=mysqli_fetch_assoc($result);
$Id_SERG = $filas ['Id_SERG'] ;
$ID = $filas ['ID_IF'] ;
?>
<div class="container">
  <div class="row">
    <div class="col-sm">


<form  action="crud_inicio_fin/update.php" method="POST" enctype="multipart/form-data" class="colm">
    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $Id_SERG ?>" >
    <input type="hidden"  class="form-control" id="id" name="id" value="<?php echo $ID ?>" >

<br>
<div class="dropdown-divider"></div>  
<h5><span class="icon-spinner4"></span>  ALMACEN </h5>
<div class="dropdown-divider"></div>
<br>
<div class="form-row" >
    <div class="col" >
    <label for="HORA_INGRESO_ALM">HORA INGRESO ALMACEN : </label>
    <input class="form-control" type="time" placeholder="00:00" id="HORA_INGRESO_ALM" name="HORA_INGRESO_ALM" value="<?php echo $filas ['HORA_INGRESO_ALM']; ?>">
    </div>

    <div class="col" >
    <label for="KM_LLEGADA_ALM">KM LLEGADA A ALMACEN: </label>
    <input class="form-control" type="number"  id="KM_LLEGADA_ALM" name="KM_LLEGADA_ALM" placeholder="00000"  value="<?php echo $filas ['KM_LLEGADA_ALM']; ?>">
    </div>
</div>

  <div class="form-group" >
    <label for="HORA_SALIDA_ALM">HORA SALIDA ALMACEN: </label>
    <input class="form-control" type="time" placeholder="00:00" id="HORA_SALIDA_ALM" name="HORA_SALIDA_ALM" value="<?php echo $filas ['HORA_SALIDA_ALM']; ?>">
  </div>

<br>
         <button id="guardar" name="guardar"  type="submit" class="btn btn-success btn-lg btn-block" id="guardar" name="guardar">
         <span class="icon-whatsapp"></span>
         ENVIAR
          </button>
  
</form>


    </div>
  </div>
</div>
<?php


} else {
$query2="
SELECT rd_segimientos_head.Id_SERG, rd_segimientos_head.S_FECHA
FROM rd_segimientos_head
WHERE (((rd_segimientos_head.Id_SERG)='$ID'));
";
$result2=mysqli_query($conexion, $query2);
$numfilas2 = mysqli_num_rows($result2);

if ($numfilas2>0) {
$filas2=mysqli_fetch_assoc($result2);
$Id_SERG = $filas2 ['Id_SERG'] ;
} else {
echo '<script>alert("No existe programación para esta PLACA. \nComuníquese con central de programaciones.");</script>';

 ?>   
<meta http-equiv="refresh" 
      content="0;url=./wt_lista.php" />
<?php

die();
}

?>
<div class="container">
  <div class="row">
    <div class="col-sm ">

<form  action="crud_inicio_fin/create.php" method="POST" enctype="multipart/form-data" class="colm">

    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $Id_SERG ?>" >



<br>
<div class="dropdown-divider"></div>  
<h5><span class="icon-spinner4"></span> ALMACEN </h5>
<div class="dropdown-divider"></div>
<br>
<div class="form-row" >
    <div class="col" >
    <label for="HORA_INGRESO_ALM">HORA INGRESO ALMACEN : </label>
    <input class="form-control" type="time" placeholder="00:00" id="HORA_INGRESO_ALM" name="HORA_INGRESO_ALM" >
    </div>

    <div class="col" >
    <label for="KM_LLEGADA_ALM">KM LLEGADA A ALMACEN: </label>
    <input class="form-control" type="number" placeholder="0000" id="KM_LLEGADA_ALM" placeholder="00000"  name="KM_LLEGADA_ALM" >
    </div>
</div>

  <div class="form-group" >
    <label for="HORA_SALIDA_ALM">HORA SALIDA ALMACEN: </label>
    <input class="form-control" type="time" placeholder="AA-MM-DD" id="HORA_SALIDA_ALM" name="HORA_SALIDA_ALM" >
  </div>


<br>
       <button id="guardar" name="guardar"  type="submit" class="btn btn-success btn-lg btn-block" id="guardar" name="guardar">
       <span class="icon-whatsapp"></span>
         ENVIAR
       </button>
  
</form>

    </div>
  </div>
</div>

<?php
}


 ?>


<?php include('includes/footer.php'); ?>

