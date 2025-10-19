<?php include('menubar.php'); ?>
<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<?php include("data/conexion.php"); ?>

<?php 

if (isset($_GET['id'])) {
$id = $_GET['id'];
/*---query ---*/
$query= "SELECT head_programaciones.id_head, head_programaciones.head_fecha, head_programaciones.head_nombre, clientes.cte_nombrecomercial
FROM head_programaciones INNER JOIN clientes ON head_programaciones.id_cliente = clientes.id_cliente
WHERE (((head_programaciones.id_head)=$id))";



/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);

	if (mysqli_num_rows($result)==1) {
		/*---almacenamos en un array ---*/
		$filas=mysqli_fetch_array($result);

		/*---recorre el resultado ---*/
		/*while($filas=mysqli_fetch_assoc($result));*/

	$c3 = $filas['head_fecha'];
	$c4 = $filas['head_nombre'];
	$c5 = $filas['id_cliente'];
	$c55 = $filas['cte_nombrecomercial'];
	$c6 = $filas['id_user'];


	}
}
?>

<div class="container p-3 mx-auto">

  <div class="row" >

    <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7">

<form  action="crud_prog/update.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>

  <div class="form-group" >
    <label for="head_fecha">FECHA DE PROGRAMACION: </label>
    <input class="form-control" type="date" placeholder="AA-MM-DD" id="head_fecha" name="head_fecha" value="<?php echo $c3?>">
  </div>

  <div class="form-group" >
    <label for="head_nombre">DESCRIPCION: </label>
    <input class="form-control" type="text" placeholder="" id="head_nombre" name="head_nombre"  value="<?php echo $c4?>">
  </div>


<div class="form-group">
  <label for="id_cliente">CLIENTE: </label>
  <select class="custom-select" id="id_cliente" name="id_cliente" required>
    
    <?php 
      $query="SELECT *FROM clientes ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_cliente']?>" >
      <?php echo $filas ['cte_nombrecomercial']  ?>
    </option>
    <?php } ?>
    <option selected value="<?php echo $c5 ?>"> <?php echo $c55 ?> </option>
  </select>
</div>
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
  
</form>


    </div>

  </div>
</div>
<?php mysqli_close($conexion); ?>

<?php include('includes/footer.php'); ?>