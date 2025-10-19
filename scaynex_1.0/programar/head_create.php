

<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">

<?php include('includes/header.php'); ?>
<?php include("../data/conexion.php"); ?>


   <?/*---formulario tabla---*/?>
<?php

if (isset($_GET['id'])) {
  $x = $_GET['id'];

     $query="

SELECT head_programaciones.hora_cita, head_programaciones.id_head, head_programaciones.head_fecha, head_programaciones.head_nombre, clientes.cte_nombrecomercial, head_programaciones.fechareg, clientes.cte_logo, head_programaciones.id_cliente
FROM head_programaciones INNER JOIN clientes ON head_programaciones.id_cliente = clientes.id_cliente
WHERE (((head_programaciones.id_head)='$x'));




        ";
     $result=mysqli_query($conexion, $query);
     $filas=mysqli_fetch_assoc($result);

  $c3 = $filas['id_cliente'];

  $c33 = $filas['cte_nombrecomercial'];

?>

<form  action="crud_head/update.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
<input class="form-control"  type="hidden" id="fechareg" name="fechareg" value="<?php echo $hoy ; ?> " readonly>

  <div class="form-group" >
    <label for="head_fecha">FECHA DE PROGRAMACION : </label>
    <input class="form-control" type="date" placeholder="AA-MM-DD" id="head_fecha" name="head_fecha" 
    value="<?php echo $filas ['head_fecha']; ?>" required>
  </div>

  <div class="form-group" >
    <label for="hora_cita">HORA DE CITA : </label>
    <input class="form-control" type="time" placeholder="00:00" id="hora_cita" name="hora_cita" 
    value="<?php echo $filas ['hora_cita']; ?>" required >
  </div>


<div class="form-group">
  <label for="id_cliente">CLIENTE : </label>
  <select class="custom-select" id="id_cliente" name="id_cliente" required>

    <?php 
      $query2="SELECT *FROM clientes ";
      $result2=mysqli_query($conexion, $query2);
    ?>
    <?php while($filas2=mysqli_fetch_assoc($result2)) { ?>
      
    <option value="<?php echo $filas2 ['id_cliente']?>" >
      <?php echo $filas2 ['cte_nombrecomercial']  ?>
    </option>
    <?php } ?>
    <option selected value="<?php echo $c3 ?>"> <?php echo $c33 ?> </option>
  </select>
</div>
       <button type="submit" class="btn btn-success btn-lg btn-block" id="guardar" name="guardar">ACTUALIZAR</button>
  
</form>


<?php


} else {
?>

<form  action="crud_head/create.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
<input class="form-control"  type="hidden" id="fechareg" name="fechareg" value="<?php echo $hoy ; ?> " readonly>

  <div class="form-group" >
    <label for="head_fecha">FECHA DE PROGRAMACION : </label>
    <input class="form-control" type="date" placeholder="AA-MM-DD" id="head_fecha" name="head_fecha" required>
  </div>

  <div class="form-group" >
    <label for="hora_cita">HORA DE CITA : </label>
    <input class="form-control" type="time" placeholder="00:00" id="hora_cita" name="hora_cita" >
  </div>


<div class="form-group">
  <label for="id_cliente">CLIENTE : </label>
  <select class="custom-select" id="id_cliente" name="id_cliente" required>
    <option selected></option>
    <?php 
      $query="SELECT *FROM clientes ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_cliente']?>" >
      <?php echo $filas ['cte_nombrecomercial']  ?>
    </option>
    <?php } ?>
  </select>
</div>
       <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
  
</form>


<?php

}





?>







<?php include('includes/footer.php'); ?>