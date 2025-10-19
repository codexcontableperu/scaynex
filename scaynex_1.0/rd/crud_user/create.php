<?php include('./../includes/header.php'); ?>

<?php include("./../../data/conexion.php"); ?>

<style>
	
	.container{  padding-top: 300px;  }

</style>

<?php
if (isset($_POST['user_dni'])) {
	$F = $_POST['FECHA'];
	$user = $_POST['user_dni'];
	
	$query="SELECT * FROM usuarios WHERE user_dni= $user ";
	$result=mysqli_query($conexion, $query);
	$numfilas = mysqli_num_rows($result);
	


	if ($numfilas>0) { 


echo '<script>alert("El DNI - Usuario ya se encuentra Registrado...");</script>';

	?>
			<meta http-equiv="refresh" content="0;url=../rd_programaciones_read.php?f=<?php echo $F ; ?>#user" />		
		</div>

	<?php

die();

	} else {

	

$c2 = $_POST['user_dni'];
$c4 = $_POST['user_nombre'];
$c5 = $_POST['user_nick'];
$c8 = $_POST['user_cargo'];
$c9 = 123;
$c10 = 2;

	$query= "INSERT INTO usuarios(  
user_dni,
user_nombre,
user_nick,
user_cargo,
user_clave,
user_perfil,

	) VALUES (
'$c2',
'$c4',
'$c5',
'$c8',
'$c9',
'$c10'
	)";

	/*---create ---*/
	$result = mysqli_query($conexion, $query);
	
echo '<script>alert("Usuario Registrado...");</script>';

	?>
			<meta http-equiv="refresh" content="0;url=../rd_programaciones_read.php?f=<?php echo $F ; ?>" />		
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