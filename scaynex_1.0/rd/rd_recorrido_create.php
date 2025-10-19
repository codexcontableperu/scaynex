<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>


   <?/*---formulario tabla---*/?>
<?php
$tabla = 'rd_recorrido';

if (isset($_GET['id'])) {
  $ID= $_GET['id'];
  $RD= $_GET['rd'];
     $query=" SELECT * FROM $tabla  WHERE ID_RECOR ='$ID' ";
     $result=mysqli_query($conexion, $query);
     $filas=mysqli_fetch_assoc($result);

?>
<div class="container">
  <div class="row">
    <div class="col-sm">



<form action="crud_tablas/update.php" method="POST">
    <input type="hidden"  class="form-control"  value="<?php echo $tabla ?>" id="tabla" name="tabla"  readonly="readonly">
    <input type="hidden"   class="form-control" id="id" name="id" value="<?php echo $ID ?>" >
    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $RD ?>" >

  <div class="form-group">
    <label for="HORA_LLEGADA_CLTE">HORA_LLEGADA_CLTE:</label>
    <input type="time" class="form-control" id="HORA_LLEGADA_CLTE" name="HORA_LLEGADA_CLTE" placeholder="HORA_LLEGADA_CLTE" value="<?php echo $filas ['HORA_LLEGADA_CLTE']; ?>">
  </div>

  <div class="form-group">
    <label for="NBULTOS">NBULTOS:</label>
    <input type="number" class="form-control" id="NBULTOS" name="NBULTOS" placeholder="NBULTOS" value="<?php echo $filas ['NBULTOS']; ?>">
  </div>

  <div class="form-group">
    <label for="DATALOGGER">DATALOGGER:</label>
    <input type="text" class="form-control" id="DATALOGGER" name="DATALOGGER" placeholder="DATALOGGER" value="<?php echo $filas ['DATALOGGER']; ?>">
  </div>

  <div class="form-group">
    <label for="PALETAS">PALETAS:</label>
    <input type="number" class="form-control" id="PALETAS" name="PALETAS" placeholder="PALETAS" value="<?php echo $filas ['PALETAS']; ?>">
  </div>

  <div class="form-group">
    <label for="HORA_SALIDA_CLTE">HORA_SALIDA_CLTE:</label>
    <input type="time" class="form-control" id="HORA_SALIDA_CLTE" name="HORA_SALIDA_CLTE" placeholder="HORA_SALIDA_CLTE" value="<?php echo $filas ['HORA_SALIDA_CLTE']; ?>">
  </div>

  <div class="form-group">
    <label for="ESTADO">ESTADO:</label>
    <input type="text" class="form-control" id="ESTADO" name="ESTADO" placeholder="ESTADO" value="<?php echo $filas ['ESTADO']; ?>">
  </div>

  <button id="guardar" name="guardar"  type="submit" class="btn btn-primary">ACTUALIZAR</button>
</form>


    </div>
  </div>
</div>
<?php


} else {
  $RD = $_GET['rd'];
?>
<div class="container">
  <div class="row">
    <div class="col-sm ">

<form action="crud_tablas/create.php" method="POST">
    <input type="hidden"  class="form-control"  value="<?php echo $tabla ?>" id="tabla" name="tabla"  readonly="readonly">
    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $RD ?>" >

  <div class="form-group">
    <label for="HORA_LLEGADA_CLTE">HORA LLEGADA AL CLIENTE:</label>
    <input type="time" class="form-control" id="HORA_LLEGADA_CLTE" name="HORA_LLEGADA_CLTE" placeholder="HORA_LLEGADA_CLTE" >
  </div>

  <div class="form-group">
    <label for="NBULTOS">CANTIDAD DE BULTOS:</label>
    <input type="number" class="form-control" id="NBULTOS" name="NBULTOS" placeholder="NBULTOS" >
  </div>

  <div class="form-group">
    <label for="DATALOGGER">DATALOGGER:</label>
    <input type="text" class="form-control" id="DATALOGGER" name="DATALOGGER" placeholder="DATALOGGER" >
  </div>

  <div class="form-group">
    <label for="PALETAS">CANTIDAD DE PALETAS:</label>
    <input type="number" class="form-control" id="PALETAS" name="PALETAS" placeholder="PALETAS" >
  </div>

  <div class="form-group">
    <label for="HORA_SALIDA_CLTE">HORA SALIDA DEL CLEINTE:</label>
    <input type="time" class="form-control" id="HORA_SALIDA_CLTE" name="HORA_SALIDA_CLTE" placeholder="HORA_SALIDA_CLTE" >
  </div>

  <div class="form-group">
    <label for="ESTADO">ESTADO:</label>
    <input type="text" class="form-control" id="ESTADO" name="ESTADO" placeholder="ESTADO" >
  </div>

  <button id="guardar" name="guardar"  type="submit" class="btn btn-primary">REGISTRAR</button>
</form>


    </div>
  </div>
</div>
<?php

}





?>







<?php include('includes/footer.php'); ?>