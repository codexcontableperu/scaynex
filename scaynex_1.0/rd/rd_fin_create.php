<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>

   <?/*---formulario tabla---*/?>
<?php
$tabla = 'rd_inicio_fin';
$F= $_GET['f'];

if (isset($_GET['id'])) {
  $ID= $_GET['id'];
  $RD= $_GET['rd'];

     $query=" SELECT * FROM $tabla  WHERE ID_IF ='$ID' ";
     $result=mysqli_query($conexion, $query);
     $filas=mysqli_fetch_assoc($result);

?>
<div class="container">
  <div class="row">
    <div class="col-sm">



<form  action="crud_tablas/updateIFIN.php" method="POST" enctype="multipart/form-data" class="colm">
    <input type="hidden"  class="form-control"  value="<?php echo $tabla ?>" id="tabla" name="tabla"  readonly="readonly">
    <input type="hidden"   class="form-control" id="id" name="id" value="<?php echo $ID ?>" >
    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $RD ?>" >
    <input type="hidden"  class="form-control" id="f" name="f" value="<?php echo $F ?>" >

<div class="dropdown-divider"></div>
<h4><span class="icon-spinner4"></span> FIN DE SERVICIO </h4>
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
         <button type="submit" class="btn btn-success btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
  
</form>


    </div>
  </div>
</div>
<?php


} else {
?>
<div class="container">
  <div class="row">
    <div class="col-sm ">

<form  action="" method="POST" enctype="multipart/form-data" class="colm">
    <input type="hidden"  class="form-control"  value="<?php echo $tabla ?>" id="tabla" name="tabla"  readonly="readonly">
    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $RD ?>" >
    <input type="hidden"  class="form-control" id="f" name="f" value="<?php echo $F ?>" >


<div class="dropdown-divider"></div>
<h4><span class="icon-spinner4"></span> FIN DE SERVICIO </h4>
<div class="dropdown-divider"></div>
<br>
<div class="form-group" >
   <label for="KM_FINAL_SERV">KM_FINAL_SERV: </label>
    <input class="form-control" type="number" placeholder="00:00" id="KM_FINAL_SERV" name="KM_FINAL_SERV" >
</div>


<div class="form-row" >
    <div class="col" >
    <label for="HORA_LLEGADA_BASE">HORA_LLEGADA_BASE : </label>
    <input class="form-control" type="time" placeholder="00:00" id="HORA_LLEGADA_BASE" name="HORA_LLEGADA_BASE" >
    </div>

    <div class="col" >
    <label for="KM_LLEGADA_BASE">KM_LLEGADA_BASE </label>
    <input class="form-control" type="number" placeholder="00:00" id="KM_LLEGADA_BASE" name="KM_LLEGADA_BASE" >
    </div>
</div>


<br>
       <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
  
</form>

    </div>
  </div>
</div>
<?php

}





?>







<?php include('includes/footer.php'); ?>