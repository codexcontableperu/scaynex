<?php include('includes/header.php'); ?>
<?php include("./../data/conexion.php"); ?>

<?php 

	$id = $_GET['id'];

     $query="
SELECT programaciones.id_prog, programaciones.id_head
FROM programaciones
WHERE (((programaciones.id_head)=$id))

				";
     $result=mysqli_query($conexion, $query);
   	$numfilas = mysqli_num_rows($result);
	


	if ($numfilas>0) { ?>

	<div class="container p-3">

	  <div class="row" >
	    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2" >

	    </div>
	    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

	    	<h3>Eliminar: </h3>
			<h6>No es posible eliminar</h6> 
			<h6>Existe registros vinculados a la programacion</h6><br>
			<a href="./head_create_read.php" class="btn btn-primary ">Cancelar</a>

	    </div>

	  </div>
	</div>

<?php  

mysqli_close($conexion);

} else {

?>
	<div class="container p-3">

	  <div class="row" >
	    <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2" >

	    </div>
	    <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

	    	<h3>Eliminar: </h3>
			<h6>Estas seguro que deseas eliminar</h6> 
			<h6>el producto...</h6><br>
			<form  action="crud_head/delete.php" method="GET" >
			<input class="form-control" type="hidden" id="id" 
			name="id" value="<?php echo $id; ?>" required>
			  <button type="submit" class="btn btn-danger" >Eliminar</button>
			</form>
			<a href="./head_create_read.php" class="btn btn-primary ">Cancelar</a>

	    </div>

	  </div>
	</div>


<?php 

}
?>

<?php include('includes/footer.php'); ?>


