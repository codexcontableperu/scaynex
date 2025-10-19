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



<form  action="crud/update.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
<input class="form-control"  type="hidden" id="fechareg" name="fechareg" value="<?php echo $hoy ; ?> " readonly>
<div class="dropdown-divider"></div>
<h4><span class="icon-spinner4"></span> FIN DE SERVICIO </h4>
<div class="dropdown-divider"></div>
<br>
<div class="form-group" >
   <label for="KM_FINAL_SERV">KM_FINAL_SERV: </label>
    <input class="form-control" type="number" placeholder="00:00" id="KM_FINAL_SERV" name="KM_FINAL_SERV" value="<?php echo $filas ['KM_FINAL_SERV']; ?>" >
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

<form  action="crud/create.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
<input class="form-control"  type="hidden" id="fechareg" name="fechareg" value="<?php echo $hoy ; ?> " readonly>
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
    <input class="form-control" type="number" placeholder="00000" id="KM_LLEGADA_BASE" name="KM_LLEGADA_BASE" >
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