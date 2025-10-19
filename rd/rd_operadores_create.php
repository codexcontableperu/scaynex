<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>


   <?/*---formulario tabla---*/?>
<?php
$tabla = 'rd_operadores';

if (isset($_GET['id'])) {
  $ID= $_GET['id'];
  $RD= $_GET['rd'];
     $query=" SELECT * FROM $tabla  WHERE ID_OPERA ='$ID' ";
     $result=mysqli_query($conexion, $query);
     $filas=mysqli_fetch_assoc($result);

?>
<div class="container">
  <div class="row">
    <div class="col-sm">

<form action="crud_operadores/update1.php" method="POST">
    <input type="hidden"  class="form-control"  value="<?php echo $tabla ?>" id="tabla" name="tabla"  readonly="readonly">
    <input type="hidden"   class="form-control" id="id" name="id" value="<?php echo $ID ?>" >
    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $RD ?>" >

  <div class="form-row">
    <label for="TIPO_OP">CARGO:</label>
    <input value="<?php echo $filas ['TIPO_OP']; ?>" class="form-control" list="TIPOOP" type="text" id="TIPO_OP" name="TIPO_OP" required>
    <datalist id="TIPOOP" >
    <option selected ></option>
    <option value="CONDUCTOR" ></option>
    <option value=" AUXILIAR1" ></option>
    <option value=" AUXILIAR2" > </option>
    <option value=" AUXILIAR3" ></option>
    </datalist>
    </div>

 <div class="form-group">
  <label for="NOMBRE">NOMBRE : </label>
  <input value="<?php echo $filas ['NOMBRE']; ?>" class="form-control" list="NOMBRES" type="text" id="NOMBRE" name="NOMBRE" required>
    <datalist id="NOMBRES" >  
    <option selected ></option>
    <?php 
      $queryP="SELECT * FROM usuarios ";
      $resultP=mysqli_query($conexion, $queryP);
    ?>
    <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
      
    <option value="<?php echo $filasP ['user_nombre']?>" >
    </option>
    <?php } ?>
  </datalist>
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
    <label for="TIPO_OP">CARGO:</label>
    <input class="form-control" list="TIPOOP" type="text" id="TIPO_OP" name="TIPO_OP" required>
    <datalist id="TIPOOP" >
    <option selected ></option>
    <option value="CONDUCTOR" ></option>
    <option value=" AUXILIAR1" ></option>
    <option value=" AUXILIAR2" > </option>
    <option value=" AUXILIAR3" ></option>
    
    </datalist>

    </div>

 <div class="form-group">
  <label for="NOMBRE">NOMBRE : </label>
  <input class="form-control" list="NOMBRES" type="text" id="NOMBRE" name="NOMBRE" required>
    <datalist id="NOMBRES" >  
    <option selected ></option>
    <?php 
      $queryP="SELECT * FROM usuarios ";
      $resultP=mysqli_query($conexion, $queryP);
    ?>
    <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
      
    <option value="<?php echo $filasP ['user_nombre']?>" >
    </option>
    <?php } ?>
  </datalist>
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