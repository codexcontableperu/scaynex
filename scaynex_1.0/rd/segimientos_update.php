<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>


   <?/*---formulario tabla---*/?>
<?php

if (isset($_GET['id'])) {
  $Id_SERG = $_GET['id'];

     $query="
SELECT  *
FROM rd_segimientos_head
WHERE Id_SERG ='$Id_SERG';
        ";
     $result=mysqli_query($conexion, $query);
     $filas=mysqli_fetch_assoc($result);

?>
<div class="container">
  <div class="row">
    <div class="col-sm">



<form action="rdfechas_create.php" method="POST">
  <input type="hidden" name="id" value="<?php echo $Id_SERG ?>">

  <div class="form-group">
    <label for="S_FECHA">FECHA:</label>
    <input type="date" class="form-control" id="S_FECHA" name="S_FECHA" placeholder="FECHA" value="<?php echo $filas ['S_FECHA']; ?>">
  </div>

  <div class="form-group">
    <label for="PLACA">PLACA:</label>
    <input type="text" class="form-control" id="PLACA" name="PLACA" placeholder="PLACA" value="<?php echo $filas ['PLACA']; ?>">
  </div>

  <button type="submit" class="btn btn-primary">ACTUALIZAR</button>
</form>


    </div>
  </div>
</div>


<?php
}
?>







<?php include('includes/footer.php'); ?>