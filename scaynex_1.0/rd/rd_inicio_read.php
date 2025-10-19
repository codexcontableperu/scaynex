<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>


   <?/*---formulario tabla---*/?>
<?php

if (isset($_GET['id'])) {
  $ID_IF = $_GET['id'];

     $query="
SELECT RD_INICIO_FIN.*
FROM RD_INICIO_FIN
WHERE (((RD_INICIO_FIN.Id_IF)='$ID_IF'));
        ";
     $result=mysqli_query($conexion, $query);
     $filas=mysqli_fetch_assoc($result);

?>
<div class="container">
  <div class="row">
    <div class="col-sm">



<form  action="crud_head/update.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
<input class="form-control"  type="hidden" id="fechareg" name="fechareg" value="<?php echo $hoy ; ?> " readonly>
<div class="dropdown-divider"></div>
<h5><span class="icon-spinner4"></span> ORIGEN BASE </h5>
<div class="dropdown-divider"></div>
<br>
<div class="form-row" >
  <div class="col" >
    <label for="HORA_SALIDA_BASE">HORA SALIDA DE BASE : </label>
    <input class="form-control" type="time" placeholder="00:00" id="HORA_SALIDA_BASE" name="HORA_SALIDA_BASE" value="<?php echo $filas ['HORA_SALIDA_BASE']; ?>">
  </div>

  <div class="col" >
    <label for="KM_SALIDA_BASE">KM SALIDA DE BASE: </label>
    <input class="form-control" type="number"  id="KM_SALIDA_BASE" name="KM_SALIDA_BASE" value="<?php echo $filas ['KM_SALIDA_BASE']; ?>">
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
    <input class="form-control" type="time" placeholder="00:00" id="HORA_INGRESO_ALM" name="HORA_INGRESO_ALM" value="<?php echo $filas ['HORA_INGRESO_ALM']; ?>">
    </div>

    <div class="col" >
    <label for="KM_LLEGADA_ALM">KM LLEGADA A ALMACEN: </label>
    <input class="form-control" type="number"  id="KM_LLEGADA_ALM" name="KM_LLEGADA_ALM" value="<?php echo $filas ['KM_LLEGADA_ALM']; ?>">
    </div>
</div>

  <div class="form-group" >
    <label for="HORA_SALIDA_ALM">HORA SALIDA ALM: </label>
    <input class="form-control" type="time" placeholder="00:00" id="HORA_SALIDA_ALM" name="HORA_SALIDA_ALM" value="<?php echo $filas ['HORA_SALIDA_ALM']; ?>">
  </div>

<br>
         <button type="submit" class="btn btn-success btn-lg btn-block" id="guardar" name="guardar">ACTUALIZAR</button>
  
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

<form  action="crud_head/create.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
<input class="form-control"  type="hidden" id="fechareg" name="fechareg" value="<?php echo $hoy ; ?> " readonly>
<div class="dropdown-divider"></div>
<h5><span class="icon-spinner4"></span> ORIGEN BASE </h5>
<div class="dropdown-divider"></div>
<br>
<div class="form-row" >
  <div class="col" >
    <label for="HORA_SALIDA_BASE">HORA SALIDA DE BASE : </label>
    <input class="form-control" type="time" placeholder="00:00" id="HORA_SALIDA_BASE" name="HORA_SALIDA_BASE" >
  </div>

  <div class="col" >
    <label for="KM_SALIDA_BASE">KM SALIDA DE BASE: </label>
    <input class="form-control" type="number" placeholder="00:00" id="KM_SALIDA_BASE" name="KM_SALIDA_BASE" >
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
    <input class="form-control" type="time" placeholder="00:00" id="HORA_INGRESO_ALM" name="HORA_INGRESO_ALM" >
    </div>

    <div class="col" >
    <label for="KM_LLEGADA_ALM">KM LLEGADA A ALMACEN: </label>
    <input class="form-control" type="number" placeholder="00:00" id="KM_LLEGADA_ALM" name="KM_LLEGADA_ALM" >
    </div>
</div>

  <div class="form-group" >
    <label for="HORA_SALIDA_ALM">HORA SALIDA ALMACEN: </label>
    <input class="form-control" type="date" placeholder="AA-MM-DD" id="HORA_SALIDA_ALM" name="HORA_SALIDA_ALM" required>
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