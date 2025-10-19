<?php include('menubar.php'); ?>
<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<?php include("../data/conexion.php"); ?>

<?php 

if (isset($_GET['id'])) {
$id = $_GET['id'];
/*---query ---*/
$query= "SELECT programaciones.id_prog, cuentas.cta_nombrecomercial, unidades.vh_placa AS asignado, unidades_1.vh_placa AS reportado, usuarios.user_nick AS conductor, usuarios_1.user_nick AS ayudante, programaciones.cant_estiva, tipo_prog.tprog_nombre, programaciones.obs_prog
FROM (((((programaciones INNER JOIN cuentas ON programaciones.id_cta = cuentas.id_cta) INNER JOIN unidades ON programaciones.vh_asignado = unidades.id_vh) INNER JOIN unidades AS unidades_1 ON programaciones.vh_reportado = unidades_1.id_vh) INNER JOIN usuarios ON programaciones.id_conductor = usuarios.id_user) INNER JOIN usuarios AS usuarios_1 ON programaciones.id_ayudante = usuarios_1.id_user) INNER JOIN tipo_prog ON programaciones.id_tprog = tipo_prog.id_tprog
WHERE (((programaciones.id_prog)=$id))";


/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);


	if (mysqli_num_rows($result)==1) {
		/*---almacenamos en un array ---*/
		$filas=mysqli_fetch_array($result);

		/*---recorre el resultado ---*/
		/*while($filas=mysqli_fetch_assoc($result));*/
		
	$c3 = $filas['id_cta'];
	$c33 = $filas['cta_nombrecomercial'];
	$c4 = $filas['vh_asignado'];
	$c44 = $filas['asignado'];
	$c5 = $filas['vh_reportado'];
	$c55 = $filas['reportado'];
	$c6 = $filas['id_conductor'];
	$c66 = $filas['conductor'];
	$c7 = $filas['id_ayudante'];
	$c77 = $filas['ayudante'];
	$c8 = $filas['cant_estiva'];
	$c9 = $filas['id_tprog'];
	$c99 = $filas['tprog_nombre'];

	$c13 = $filas['obs_prog'];

	}
}
?>


    </div>
    <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7">


   <?/*---formulario tabla---*/?>

<form  action="crud_header/create.php" method="POST" enctype="multipart/form-data" class="colm">


<input class="form-control"  type="hidden" id="id_head" name="id_head" value="<?php echo $id_head ; ?> " readonly>

<div class="form-group">
  <label for="id_cliente">CUENTA: </label>
  <select class="custom-select" id="id_cliente" name="id_cliente" required>
    
    <?php 
      $query="SELECT * FROM  cuentas ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_cta']?>" >
      <?php echo $filas ['cta_nombrecomercial']  ?>
    </option>
    <?php } ?>
    <option selected value="<?php echo $c3 ?>"> <?php echo $c33 ?> </option>
  </select>
</div>

<div class="form-group">
  <label for="id_tprog">TIPO PROGRAMACION: </label>
  <select class="custom-select" id="id_tprog" name="id_tprog" required>
    
    <?php 
      $query="SELECT * FROM  usuarios ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_user']?>" >
      <?php echo $filas ['user_nick']  ?>  
    </option>

    <?php } ?>
    <option selected value="<?php echo $c9 ?>"> <?php echo $c99 ?> </option>
  </select>
</div>



<div class="form-group">
  <label for="vh_asignado">VEHICULO ASIGNADO: </label>
  <select class="custom-select" id="vh_asignado" name="vh_asignado" required>

    <?php 
      $query="SELECT * FROM  unidades ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_vh']?>" >
      <?php echo $filas ['vh_placa']  ?>  &nbsp <?php echo $filas ['vh_nick']  ?>
    </option>
    <?php } ?>
    <option selected value="<?php echo $c4 ?>"> <?php echo $c44 ?> </option>
  </select>
</div>

<div class="form-group">
  <label for="vh_reportado">VEHICULO REPORTADO: </label>
  <select class="custom-select" id="vh_reportado" name="vh_reportado" required>
    
    <?php 
      $query="SELECT * FROM  unidades ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_vh']?>" >
      <?php echo $filas ['vh_placa']  ?>  &nbsp <?php echo $filas ['vh_nick']  ?>
    </option>
    <?php } ?>
    <option selected value="<?php echo $c5 ?>"> <?php echo $c55 ?> </option>
  </select>
</div>

<div class="form-group">
  <label for="id_conductor">CONDUCTOR: </label>
  <select class="custom-select" id="id_conductor" name="id_conductor" required>
   
    <?php 
      $query="SELECT * FROM  usuarios ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_user']?>" >
      <?php echo $filas ['user_nick']  ?>  
    </option>
    <?php } ?>
    <option selected value="<?php echo $c6 ?>"> <?php echo $c66 ?> </option>
  </select>
</div>

<div class="form-group">
  <label for="id_ayudante">AYUDANTE: </label>
  <select class="custom-select" id="id_ayudante" name="id_ayudante" required>
   
    <?php 
      $query="SELECT * FROM  usuarios ";
      $result=mysqli_query($conexion, $query);
    ?>
    <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      
    <option value="<?php echo $filas ['id_user']?>" >
      <?php echo $filas ['user_nick']  ?>  
    </option>
    <?php } ?>
    <option selected value="<?php echo $c7 ?>"> <?php echo $c77 ?> </option>
  </select>
</div>

  <div class="form-group" >
    <label for="cant_estiva">CANTIDAD DE ESTIVADORES </label>
    <input class="form-control" type="number" placeholder="0" id="cant_estiva" name="cant_estiva"  value="<?php echo $c8; ?>">
  </div>


  <div class="form-group" >
    <label for="obs_prog">OBSERVACIONES: </label>
    <input class="form-control" type="text" placeholder="" id="obs_prog" name="obs_prog"  value="<?php echo $c13; ?>" >
  </div>



      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
  
</form>



    </div>

  </div>
</div>
<?php mysqli_close($conexion); ?>

<?php include('includes/footer.php'); ?>