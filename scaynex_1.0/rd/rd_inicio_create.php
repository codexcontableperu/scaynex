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


<form  action="crud_tablas/updateIF.php" method="POST" enctype="multipart/form-data" class="colm">
    <input type="hidden"  class="form-control"  value="<?php echo $tabla ?>" id="tabla" name="tabla"  readonly="readonly">
    <input type="hidden"   class="form-control" id="id" name="id" value="<?php echo $ID ?>" >
    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $RD ?>" >
    <input type="hidden"  class="form-control" id="f" name="f" value="<?php echo $F ?>" >


<div class="dropdown-divider"></div>
<h4><span class="icon-spinner4"></span> ORIGEN ALMACEN </h4>
<div class="dropdown-divider"></div>
<br>
<div class="form-row" >
  <div class="col" >
    <label for="HORA_SALIDA_BASE">HORA SALIDA DE BASE : </label>
    <input class="form-control" type="time" placeholder="00:00" id="HORA_SALIDA_BASE" name="HORA_SALIDA_BASE" value="<?php echo $filas ['HORA_SALIDA_BASE']; ?>">
  </div>

  <div class="col" >
    <label for="KM_SALIDA_BASE">KM SALIDA DE BASE: </label>
    <input class="form-control" type="number"  id="KM_SALIDA_BASE" name="KM_SALIDA_BASE" placeholder="00000" value="<?php echo $filas ['KM_SALIDA_BASE']; ?>">
  </div>
  </div>
<br>
<div class="dropdown-divider"></div>  
<h5><span class="icon-spinner4"></span> DESTINO BASE </h5>
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
         <button id="guardar" name="guardar"  type="submit" class="btn btn-success btn-lg btn-block" id="guardar" name="guardar">ACTUALIZAR</button>
  
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

<form  action="crud_tablas/createIF.php" method="POST" enctype="multipart/form-data" class="colm">
    <input type="hidden"  class="form-control"  value="<?php echo $tabla ?>" id="tabla" name="tabla"  readonly="readonly">
    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $RD ?>" >
    <input type="hidden"  class="form-control" id="f" name="f" value="<?php echo $F ?>" >


<div class="dropdown-divider"></div>
<h5><span class="icon-spinner4"></span> ORIGEN BASE </h5>
<div class="dropdown-divider"></div>
<br>
<div class="form-row" >
  <div class="col" >
    <label for="HORA_SALIDA_BASE">HORA SALIDA DE BASE : </label>
    <input class="form-control" type="time" placeholder="00:00" id="HORA_SALIDA_BASE" name="HORA_SALIDA_BASE" required >
  </div>

  <div class="col" >
    <label for="KM_SALIDA_BASE">KM SALIDA DE BASE: </label>
    <input class="form-control" type="number" placeholder="0000" id="KM_SALIDA_BASE" placeholder="00000"  name="KM_SALIDA_BASE" required >
  </div>
  </div>
<br>
<div class="dropdown-divider"></div>  
<h5><span class="icon-spinner4"></span> DESTINO ALMACEN </h5>
<div class="dropdown-divider"></div>
<br>
<div class="form-row" >
    <div class="col" >
    <label for="HORA_INGRESO_ALM">HORA INGRESO ALMACEN : </label>
    <input class="form-control" type="time" placeholder="00:00" id="HORA_INGRESO_ALM" name="HORA_INGRESO_ALM" value="00:00">
    </div>

    <div class="col" >
    <label for="KM_LLEGADA_ALM">KM LLEGADA A ALMACEN: </label>
    <input class="form-control" type="number" placeholder="0000" id="KM_LLEGADA_ALM" placeholder="00000"  name="KM_LLEGADA_ALM" value="00" >
    </div>
</div>

  <div class="form-group" >
    <label for="HORA_SALIDA_ALM">HORA SALIDA ALMACEN: </label>
    <input class="form-control" type="time" placeholder="00:00:00" id="HORA_SALIDA_ALM" name="HORA_SALIDA_ALM" value="00:00:00">
  </div>


<br>
       <button id="guardar" name="guardar"  type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
  
</form>

    </div>
  </div>
</div>
<?php

}





?>







<?php include('includes/footer.php'); ?>