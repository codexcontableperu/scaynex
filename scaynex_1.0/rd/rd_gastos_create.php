<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>


   <?/*---formulario tabla---*/?>
<?php
$tabla = 'rd_gastos';

if (isset($_GET['id'])) {
  $ID= $_GET['id'];
  $RD= $_GET['rd'];
     $query=" SELECT * FROM $tabla  WHERE ID_GASTO ='$ID' ";
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

 
  <div class="form-row">
    <label for="G_TIPO">TIPO DE GASTO:</label>
    <input value="<?php echo $filas ['G_TIPO']; ?>" class="form-control" list="gastos" type="text" id="G_TIPO" name="G_TIPO" required>
    <datalist id="gastos" >
    <option selected ></option>
    <option value=" Peaje" ></option>
    <option value=" Reparaciones" ></option>
    <option value=" policia" > </option>
    <option value=" accesorios" ></option>
    <option value=" suministros" ></option>
    </datalist>

    </div>

  <div class="form-group">
    <label for="DESCRIPCION">DESCRIPCION:</label>
    <input type="text" class="form-control" id="DESCRIPCION" name="DESCRIPCION" placeholder="DESCRIPCION" value="<?php echo $filas ['DESCRIPCION']; ?>">
  </div>

  <div class="form-group">
    <label for="IMPORTE">IMPORTE:</label>
    <input type="number" class="form-control" id="IMPORTE" name="IMPORTE" placeholder="IMPORTE" value="<?php echo $filas ['IMPORTE']; ?>">
  </div>

  <div class="form-group">
    <label for="G_FECHA">G_FECHA:</label>
    <input type="date" class="form-control" id="G_FECHA" name="G_FECHA" value="<?php echo $filas ['G_FECHA']; ?>">
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

  <div class="form-row">
        <label for="G_TIPO">TIPO DE GASTO:</label>
    <input class="form-control" list="gastos" type="text" id="G_TIPO" name="G_TIPO" required>
    <datalist id="gastos" >
    <option selected></option>
    <option value=" Peaje" ></option>
    <option value=" Reparaciones" ></option>
    <option value=" policia" > </option>
    <option value=" accesorios" ></option>
    <option value=" suministros" ></option>
    </datalist>

    </div>

  <div class="form-group">
    <label for="DESCRIPCION">DESCRIPCION:</label>
    <input type="text" class="form-control" id="DESCRIPCION" name="DESCRIPCION" placeholder="DESCRIPCION" >
  </div>

  <div class="form-group">
    <label for="IMPORTE">IMPORTE:</label>
    <input type="number" class="form-control" id="IMPORTE" name="IMPORTE" placeholder="IMPORTE" >
  </div>

  <div class="form-group">
    <label for="G_FECHA">G_FECHA:</label>
    <input type="date" class="form-control" id="G_FECHA" name="G_FECHA" >
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