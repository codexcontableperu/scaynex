<?php include('./../includes/header.php'); ?>

<?php include("./../../data/conexion.php"); ?>

<style>
	
	.container{  padding-top: 300px;  }

</style>

<?php
if (isset($_POST['user_dni'])) {
	
	$user = $_POST['user_dni'];
	

	$query="SELECT * FROM usuarios WHERE user_dni= $user ";
	$result=mysqli_query($conexion, $query);
	$numfilas = mysqli_num_rows($result);
	


	if ($numfilas>0) { ?>

		<div class="container col-7">

			<h5>El nombre de Usuario ya se encuentra Registrado...</h5>
	
			<a href="./../registro.php" class="btn btn-primary  btn-block" >Regresar...</a>		
		</div>

<?php


	} else {

	

$c2 = $_POST['user_dni'];
$c4 = $_POST['user_nombre'];
$c5 = $_POST['user_nick'];


$c8 = $_POST['user_cargo'];
$c9 = 123;
$c10 = $_POST['user_perfil'];
$c14 = $_POST['user_salario'];
$c15 = $_POST['user_hingreso'];


	$query= "INSERT INTO usuarios(  
user_dni,
user_nombre,
user_nick,


user_cargo,
user_clave,
user_perfil,
user_salario,
user_hingreso

	) VALUES (
'$c2',
'$c4',
'$c5',


'$c8',
'$c9',
'$c10',
'$c14',
'$c15'

	)";

	/*---create ---*/
	$result = mysqli_query($conexion, $query);?>
	

		<div class="container col-7">

			<h5>Nuevo Usuario Registrado...</h5>
	
			<meta http-equiv="refresh" content="2;url=../user_listado.php" />		
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