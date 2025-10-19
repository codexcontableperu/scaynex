<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>


   <?/*---formulario tabla---*/?>
<?php
$tabla = 'rd_combustible';

if (isset($_GET['id'])) {
  $ID= $_GET['id'];
  $RD= $_GET['rd'];
     $query=" SELECT * FROM $tabla  WHERE ID_COMB ='$ID' ";
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
    <label for="COM_SOLES">IMPORTE:</label>
    <input type="number" class="form-control" id="COM_SOLES" name="COM_SOLES" step="any" placeholder="0.00" value="<?php echo $filas ['COM_SOLES']; ?>">
  </div>

  <div class="form-group">
    <label for="COM_GALONES">GALONES:</label>
    <input type="number" class="form-control" id="COM_GALONES" name="COM_GALONES" step="any" value="<?php echo $filas ['COM_GALONES']; ?>">
  </div>

  <div class="form-group">
    <label for="KILOMETRAJE">KILOMETRAJE:</label>
    <input type="number" class="form-control" id="KILOMETRAJE" name="KILOMETRAJE" step="any" value="<?php echo $filas ['KILOMETRAJE']; ?>">
  </div>

  <div class="form-group">
    <label for="NFACTURA">NUMERO DE FACTURA:</label>
    <input type="text" class="form-control" id="NFACTURA" name="NFACTURA" placeholder="E001-0000" value="<?php echo $filas ['NFACTURA']; ?>">
  </div>

  <div class="form-group">
    <label for="GASOLINERA">GASOLINERA:</label>
    <input type="text" class="form-control" id="GASOLINERA" name="GASOLINERA" placeholder="Razon Social" value="<?php echo $filas ['GASOLINERA']; ?>">
  </div>

  <div class="form-group">
    <label for="COM_FECHA">FECHA:</label>
    <input type="date" class="form-control" id="COM_FECHA" name="COM_FECHA" value="<?php echo $filas ['COM_FECHA']; ?>">
  </div>

  <div class="form-group">
    <label for="COM_HORA">HORA:</label>
    <input type="time" class="form-control" id="COM_HORA" name="COM_HORA" value="<?php echo $filas ['COM_HORA']; ?>">
  </div>

  <button  id="guardar" name="guardar"  type="submit" class="btn btn-primary">ACTUALIZAR</button>
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
    <label for="COM_SOLES">IMPORTE:</label>
    <input type="number" class="form-control" id="COM_SOLES" name="COM_SOLES" step="any" placeholder="0.00" >
  </div>

  <div class="form-group">
    <label for="COM_GALONES">GALONES:</label>
    <input type="number" class="form-control" id="COM_GALONES" name="COM_GALONES" step="any" >
  </div>

  <div class="form-group">
    <label for="KILOMETRAJE">KILOMETRAJE:</label>
    <input type="number" class="form-control" id="KILOMETRAJE" name="KILOMETRAJE" step="any" >
  </div>

  <div class="form-group">
    <label for="NFACTURA">NUMERO DE FACTURA:</label>
    <input type="text" class="form-control" id="NFACTURA" name="NFACTURA" placeholder="E001-0000" >
  </div>

  <div class="form-group">
    <label for="GASOLINERA">GASOLINERA:</label>
    <input type="text" class="form-control" id="GASOLINERA" name="GASOLINERA" placeholder="Razon Social" >
  </div>

  <div class="form-group">
    <label for="COM_FECHA">FECHA:</label>
    <input type="date" class="form-control" id="COM_FECHA" name="COM_FECHA" >
  </div>

  <div class="form-group">
    <label for="COM_HORA">HORA:</label>
    <input type="time" class="form-control" id="COM_HORA" name="COM_HORA" >
  </div>

  <button  id="guardar" name="guardar"  type="submit" class="btn btn-primary">REGISTRAR</button>
</form>


    </div>
  </div>
</div>
<?php

}





?>







<?php include('includes/footer.php'); ?>