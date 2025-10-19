<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>


   <?/*---formulario tabla---*/?>
<?php
$tabla = 'rd_responsables';

if (isset($_GET['id'])) {
  $ID= $_GET['id'];
  $RD= $_GET['rd'];
     $query=" SELECT * FROM $tabla  WHERE ID_RESP ='$ID' ";
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
    <label for="LIQUIDADO">LIQUIDADO:</label>
    <input type="text" class="form-control" id="LIQUIDADO" name="LIQUIDADO" value="<?php echo $filas ['LIQUIDADO']; ?>">
  </div>

  <div class="form-group">
    <label for="PASO_RCD">PASO RCD:</label>
    <input type="text" class="form-control" id="PASO_RCD" name="PASO_RCD" placeholder="PASO_RCD" value="<?php echo $filas ['PASO_RCD']; ?>">
  </div>

  <div class="form-group">
    <label for="ENVIADO">ENVIADO:</label>
    <input type="text" class="form-control" id="ENVIADO" name="ENVIADO" value="<?php echo $filas ['ENVIADO']; ?>">
  </div>

  <div class="form-group">
    <label for="OBSERVACION">OBSERVACION:</label>
    <textarea class="form-control" id="OBSERVACION" name="OBSERVACION" placeholder="OBSERVACION" value="<?php echo $filas ['OBSERVACION']; ?>"></textarea>
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
    <label for="LIQUIDADO">LIQUIDADO:</label>
    <input type="text" class="form-control" id="LIQUIDADO" name="LIQUIDADO" >
  </div>

  <div class="form-group">
    <label for="PASO_RCD">PASO RCD:</label>
    <input type="text" class="form-control" id="PASO_RCD" name="PASO_RCD" placeholder="PASO_RCD" >
  </div>

  <div class="form-group">
    <label for="ENVIADO">ENVIADO:</label>
    <input type="text" class="form-control" id="ENVIADO" name="ENVIADO" >
  </div>

  <div class="form-group">
    <label for="OBSERVACION">OBSERVACION:</label>
    <textarea class="form-control" id="OBSERVACION" name="OBSERVACION" placeholder="OBSERVACION"></textarea>
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