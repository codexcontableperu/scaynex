<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>


   <?/*---formulario tabla---*/?>
<?php
$tabla = 'diario';

if (isset($_GET['id'])) {
  $ID= $_GET['id'];
  $RD= $_GET['rd'];
  $OP= $_GET['op'];
     $query=" 
SELECT diario.ID_DIARIO, diario.ID_OPERA, diario.Id_SERG, diario.CTA_CONT, diario.IMPORTE, diario.FECHA_DOC, diario.GLOSA, pcge.CTA_NOMBRE, diario.DH, pcge.ID_CTA
FROM diario INNER JOIN pcge ON diario.CTA_CONT = pcge.ID_CTA
WHERE (((diario.ID_DIARIO)='$ID'));


     ";
     $result=mysqli_query($conexion, $query);
     $filas=mysqli_fetch_assoc($result);

?>

<br>
<div class="container">
  <div class="row">
    <div class="col-sm">

<form action="crud_diario/update.php" method="POST">

    <input type="text"  class="form-control" id="ID_D" name="ID_D" value="<?php echo $ID ?>" >
    <input type="hidden"  class="form-control" id="ID_OPERA" name="ID_OPERA" value="<?php echo $OP ?>" >
    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $RD ?>" >

<div class="form-group">
  <label for="CTA_CONT">TIPO </label>
  <select class="custom-select" id="CTA_CONT" name="CTA_CONT"  required >
<option >  </option>
<option selected value="<?php echo $filas ['ID_CTA']; ?>" > <?php echo $filas ['CTA_NOMBRE']; ?> </option>
    <?php 
      $queryT="SELECT pcge.ID_CTA, pcge.CTA_NOMBRE, pcge.TRESDIGITOS, pcge.NIVEL
      FROM pcge
      WHERE (((pcge.TRESDIGITOS)=101) AND ((pcge.NIVEL)=5));
      ";
      $resultT=mysqli_query($conexion, $queryT);
    ?>
    <?php while($filasT=mysqli_fetch_assoc($resultT)) { ?>
      
    <option value="<?php echo $filasT ['ID_CTA']?>" >
      <?php echo $filasT ['CTA_NOMBRE']  ?>
    </option>
    <?php } ?>

  </select>
</div>

<div class="form-group">
<label for="IMPORTE">IMPORTE</label>
  <input type="number" step="any" class="form-control" id="IMPORTE"  name="IMPORTE" placeholder="S/. 0.00" value="<?php echo $filas ['IMPORTE']; ?>" required>
</div>



  <div class="form-group">
    <label for="GLOSA">OBSERVACION</label>
    <input type="text" class="form-control" id="GLOSA" name="GLOSA" value="<?php echo $filas ['GLOSA']; ?>" >
  </div>

  
<button id="guardar" name="guardar"  type="submit" class="btn btn-primary">ACTUALIZAR</button>
</form>



    </div>
  </div>
</div>
<?php


} else {
  $RD = $_GET['rd'];
  $OP= $_GET['op'];
?>
<br>
<div class="container">
  <div class="row">
    <div class="col-sm ">

<form action="crud_diario/create_arendir.php" method="POST">
    <input type="hidden"  class="form-control" id="ID_OPERA" name="ID_OPERA" value="<?php echo $OP ?>" >
    <input type="hidden"  class="form-control" id="Id_SERG" name="Id_SERG" value="<?php echo $RD ?>" >

<div class="form-group">
  <label for="CTA_CONT">TIPO </label>
  <select class="custom-select" id="CTA_CONT" name="CTA_CONT" value="<?php echo $filas ['CTA_CONT']; ?>" required >
<option >  </option>
    <?php 
      $queryT="SELECT pcge.ID_CTA, pcge.CTA_NOMBRE, pcge.TRESDIGITOS, pcge.NIVEL
      FROM pcge
      WHERE (((pcge.TRESDIGITOS)=101) AND ((pcge.NIVEL)=5));
      ";
      $resultT=mysqli_query($conexion, $queryT);
    ?>
    <?php while($filasT=mysqli_fetch_assoc($resultT)) { ?>
      
    <option value="<?php echo $filasT ['ID_CTA']?>" >
      <?php echo $filasT ['CTA_NOMBRE']  ?>
    </option>
    <?php } ?>

  </select>
</div>

<div class="form-group">
<label for="importe">IMPORTE</label>
  <input type="number" step="any" class="form-control" id="importe"  name="importe" placeholder="S/. 0.00" required>
</div>

  <div class="form-group">
    <label for="GLOSA">OBSERVACION</label>
    <input type="text" class="form-control" id="GLOSA" name="GLOSA" >
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