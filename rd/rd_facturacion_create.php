<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>

   <?/*---formulario tabla---*/?>
<?php
$tabla = 'rd_facturacion';

if (isset($_GET['id'])) {
  $ID= $_GET['id'];
  $RD= $_GET['rd'];
     $query=" SELECT * FROM $tabla  WHERE ID_FT ='$ID' ";
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
    <label for="FLETE">FLETE:</label>
    <input type="text" class="form-control" id="FLETE" name="FLETE" placeholder="FLETE" value="<?php echo $filas ['FLETE']; ?>">
  </div>

  <div class="form-group">
    <label for="NFACTURA">NFACTURA:</label>
    <input type="text" class="form-control" id="NFACTURA" name="NFACTURA" placeholder="NFACTURA" value="<?php echo $filas ['NFACTURA']; ?>">
  </div>

  <div class="form-group">
    <label for="FT_FECHA">FT_FECHA:</label>
    <input type="date" class="form-control" id="FT_FECHA" name="FT_FECHA" placeholder="FT_FECHA" value="<?php echo $filas ['FT_FECHA']; ?>">
  </div>

  <div class="form-group">
  <label for="CLIENTE">CLIENTE : </label>
  <input value="<?php echo $filas ['CLIENTE']; ?>" class="form-control" list="CLIENTES" type="text" id="CLIENTE" name="CLIENTE" required>
    <datalist id="CLIENTES" >  
    <option selected ></option>
    <?php 
      $queryP="SELECT * FROM clientes ";
      $resultP=mysqli_query($conexion, $queryP);
    ?>
    <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
      
    <option value="<?php echo $filasP ['cte_nombrecomercial']?>" >
    </option>
    <?php } ?>
  </datalist>
</div>



  <div class="form-group">
    <label for="ESTADO">ESTADO:</label>
    <input type="text" class="form-control" id="ESTADO" name="ESTADO" placeholder="ESTADO" value="<?php echo $filas ['ESTADO']; ?>">
  </div>



  <button id="guardar" name="guardar" type="submit" class="btn btn-primary">ACTUALIZAR</button>
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
    <label for="FLETE">FLETE:</label>
    <input type="text" class="form-control" id="FLETE" name="FLETE" placeholder="FLETE" >
  </div>

  <div class="form-group">
    <label for="NFACTURA">NFACTURA:</label>
    <input type="text" class="form-control" id="NFACTURA" name="NFACTURA" placeholder="NFACTURA" >
  </div>

  <div class="form-group">
    <label for="FT_FECHA">FT_FECHA:</label>
    <input type="date" class="form-control" id="FT_FECHA" name="FT_FECHA" placeholder="FT_FECHA" >
  </div>


<div class="form-group">
  <label for="CLIENTE">CLIENTE : </label>
  <input class="form-control" list="CLIENTE" type="text" id="CLIENTE" name="CLIENTE" required>
    <datalist id="CLIENTE" >  
    <option selected ></option>
    <?php 
      $query="SELECT *FROM clientes ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['cte_nombrecomercial']?>" >
    </option>
    <?php } ?>
  </datalist>
</div>



  <div class="form-group">
    <label for="ESTADO">ESTADO:</label>
    <input type="text" class="form-control" id="ESTADO" name="ESTADO" placeholder="ESTADO" >
  </div>

  <button id="guardar" name="guardar" type="submit" class="btn btn-primary">REGISTRAR</button>
</form>



    </div>
  </div>
</div>
<?php

}





?>







<?php include('includes/footer.php'); ?>