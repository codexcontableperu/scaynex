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

$PLACA=$_POST['PLACA'];

$query="
SELECT RD_INICIO_FIN.*, rd_segimientos_head.PLACA
FROM RD_INICIO_FIN INNER JOIN rd_segimientos_head ON RD_INICIO_FIN.Id_SERG = rd_segimientos_head.Id_SERG
WHERE (((rd_segimientos_head.PLACA)='$PLACA') AND ((rd_segimientos_head.S_FECHA)='$hoy'))
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


<form  action="crud_inicio_fin/updateF.php" method="POST" enctype="multipart/form-data" class="colm">
    <input type="hidden"  class="form-control" id="id" name="id" value="<?php echo $ID ?>" >
    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $Id_SERG ?>" >
<div class="dropdown-divider"></div>
<h4><span class="icon-spinner4"></span> FIN DE SERVICIO</h4>
<div class="dropdown-divider"></div>
<br>
<div class="form-group" >
   <label for="KM_FINAL_SERV">KM FINAL SERVICIO: </label>
    <input class="form-control" type="number" placeholder="00000" id="KM_FINAL_SERV" name="KM_FINAL_SERV" value="<?php echo $filas ['KM_FINAL_SERV']; ?>" >
</div>


<div class="form-row" >
    <div class="col" >
    <label for="HORA_LLEGADA_BASE">HORA_LLEGADA_BASE : </label>
    <input class="form-control" type="time" placeholder="00:00" id="HORA_LLEGADA_BASE" name="HORA_LLEGADA_BASE" value="<?php echo $filas ['HORA_LLEGADA_BASE']; ?>">
    </div>

    <div class="col" >
    <label for="KM_LLEGADA_BASE">KM_LLEGADA_BASE </label>
    <input class="form-control" type="number" placeholder="00000" id="KM_LLEGADA_BASE" name="KM_LLEGADA_BASE" value="<?php echo $filas ['KM_LLEGADA_BASE']; ?>">
    </div>
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
SELECT rd_segimientos_head.Id_SERG, rd_segimientos_head.S_FECHA, rd_segimientos_head.PLACA
FROM rd_segimientos_head
WHERE (((rd_segimientos_head.S_FECHA)='$hoy') AND ((rd_segimientos_head.PLACA)='$PLACA'))
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
      content="0;url=./wt_idplaca_fin.php" />
<?php

die();
}

?>
<div class="container">
  <div class="row">
    <div class="col-sm ">

<form  action="crud_inicio_fin/createF.php" method="POST" enctype="multipart/form-data" class="colm">

    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $Id_SERG ?>" >


<div class="dropdown-divider"></div>
<h5><span class="icon-spinner4"></span>  FIN DE SERVICIO  </h5>
<div class="dropdown-divider"></div>
<br>
<div class="form-group" >
   <label for="KM_FINAL_SERV">KM FINAL SERVICIO: </label>
    <input class="form-control" type="number" placeholder="00000" id="KM_FINAL_SERV" name="KM_FINAL_SERV"  >
</div>


<div class="form-row" >
    <div class="col" >
    <label for="HORA_LLEGADA_BASE">HORA_LLEGADA_BASE : </label>
    <input class="form-control" type="time" placeholder="00:00" id="HORA_LLEGADA_BASE" name="HORA_LLEGADA_BASE" >
    </div>

    <div class="col" >
    <label for="KM_LLEGADA_BASE">KM_LLEGADA_BASE </label>
    <input class="form-control" type="number" placeholder="00000" id="KM_LLEGADA_BASE" name="KM_LLEGADA_BASE" >
    </div>
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

