<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>


   <?/*---formulario tabla---*/?>
<?php

$tabla = 'rd_servicio';

if (isset($_GET['id'])) {
  $ID= $_GET['id'];
  $RD= $_GET['rd'];
     $query=" SELECT * FROM $tabla  WHERE ID_SERV ='$ID' ";
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
    <label for="TEMPERATURA">TIPO_CARGA:</label>
    <input type="text" class="form-control" id="TEMPERATURA" name="TEMPERATURA" placeholder="TEMPERATURA" value="<?php echo $filas ['TEMPERATURA']; ?>">
  </div>

  <div class="form-group">
    <label for="PLACA">PLACA:</label>
    <input type="text" class="form-control" id="PLACA" name="PLACA" placeholder="PLACA" value="<?php echo $filas ['PLACA']; ?>">
  </div>

  <div class="form-group">
    <label for="CUENTA">CUENTA:</label>
    <input type="text" class="form-control" id="CUENTA" name="CUENTA" placeholder="CUENTA" value="<?php echo $filas ['CUENTA']; ?>">
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
    <label for="CITA">CITA:</label>
    <input type="time" class="form-control" id="CITA" name="CITA"  value="<?php echo $filas ['CITA']; ?>">
  </div>

  <div class="form-group">
    <label for="NRO_GUIA">NRO DE GUIA:</label>
    <input type="text" class="form-control" id="NRO_GUIA" name="NRO_GUIA" placeholder="NRO_GUIA" value="<?php echo $filas ['NRO_GUIA']; ?>">
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
    <input type="hidden"  class="form-control"  
    value="<?php echo $tabla ?>" id="tabla" name="tabla"  >

    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $RD ?>" >

  <div class="form-group">
    <label for="TEMPERATURA">TIPO_CARGA:</label>
    <input type="text" class="form-control" id="TEMPERATURA" name="TEMPERATURA" placeholder="TEMPERATURA" >
  </div>

<div class="form-group">
  <label for="PLACA">PLACA : </label>
  <input class="form-control" list="PLACAS" type="text" id="PLACA" name="PLACA" required>
    <datalist id="PLACAS" >  
    <option selected ></option>
    <?php 
      $queryP="SELECT * FROM unidades ";
      $resultP=mysqli_query($conexion, $queryP);
    ?>
    <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
      
    <option value="<?php echo $filasP ['vh_placa']?>" >
    </option>
    <?php } ?>
  </datalist>
</div>


  <div class="form-group">
    <label for="CUENTA">CUENTA:</label>
    <input type="text" class="form-control" id="CUENTA" name="CUENTA" placeholder="CUENTA" >
  </div>

<div class="form-group">
  <label for="CLIENTE">CLIENTE : </label>
  <input class="form-control" list="CLIENTES" type="text" id="CLIENTE" name="CLIENTE" required>
    <datalist id="CLIENTES" >  
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
    <label for="CITA">CITA:</label>
    <input type="time" class="form-control" id="CITA" name="CITA"  >
  </div>

  <div class="form-group">
    <label for="NRO_GUIA">NRO DE GUIA:</label>
    <input type="text" class="form-control" id="NRO_GUIA" name="NRO_GUIA" placeholder="NRO_GUIA" >
  </div>

  <button id="guardar" name="guardar"  type="submit" class="btn btn-primary btn-block">REGISTRAR</button>
</form>

    </div>
  </div>
</div>
<?php

}





?>







<?php include('includes/footer.php'); ?>