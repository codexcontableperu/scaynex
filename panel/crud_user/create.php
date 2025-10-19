<?php include('./../includes/header.php'); ?>

<?php include("./../data/conexion.php"); ?>

<style>
	
	.container{  padding-top: 300px;  }

</style>

<?php
if (isset($_POST['user_nombre'])) {
	
	$user = $_POST['user_nombre'];
	

	$query="SELECT * FROM user WHERE user_nombre= '$user' ";
	$result=mysqli_query($conexion, $query);
	$numfilas = mysqli_num_rows($result);
	


	if ($numfilas>0) { ?>

		<div class="container col-7">

			<h5>El nombre de Usuario ya se encuentra Registrado...</h5>
	
			<a href="./../registro.php" class="btn btn-primary  btn-block" >Regresar...</a>		
		</div>

<?php
	die();

	} else {

	

	$c2 = $_POST['user_nombre'];
	$c3 = $_POST['user_empresa'];
	$c4 = $_POST['user_correo'];
	$c5 = 1; /*$_POST['user_activo'];*/
	$c6 = $_POST['user_clave'];
	$c7 = 2; /*$_POST['user_nivel'];*/
	$c8 = "./img/portada.jpg";/*$_POST['user_portada'];*/
	$c9 = "./img/logo.jpg";/*$_POST['user_logo'];*/

	$query= "INSERT INTO user(  
	user_nombre,
	user_empresa,
	user_correo,
	user_activo,
	user_clave,
	user_nivel,
	user_portada,
	user_logo
	) VALUES (
	'$c2',
	'$c3',
	'$c4', 
	'$c5', 
	'$c6', 
	'$c7',
	'$c8',   
	'$c9'
	)";

	/*---create ---*/
	$result = mysqli_query($conexion, $query);?>
	

		<div class="container col-7">

			<h5>Nuevo Usuario Registrado...</h5>
	
			<a href="./../index.php" class="btn btn-primary  btn-block" >INGRESAR...</a>		
		</div>

	<?php	

	}

	} else {

	mysqli_close($conexion);
	echo'<script type="text/javascript">
    window.location.href="./../index.php";
    </script>';
	exit();
	die();
	}


	?>

	<?php include('./../includes/footer.php'); ?>