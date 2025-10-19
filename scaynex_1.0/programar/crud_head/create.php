<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ARTICULOS---*/

if (isset($_POST['guardar'])) {

	$c2 = 1;
	$c3 = $_POST['head_fecha'];
	$c4 = $_POST['hora_cita'];
	$c5 = $_POST['id_cliente'];
	$c6 = $_POST['id_user'];
	$c7 = $_POST['fechareg'];


$query= "INSERT INTO head_programaciones(  
id_emp,  
head_fecha,
hora_cita,
id_cliente,
id_user,
fechareg
) VALUES (
'$c2',
'$c3',
'$c4',
'$c5',
'$c6',
'$c7'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);


/*---secion para msj ---*/

/*---redireccion ---*/
mysqli_close($conexion);	
echo'<script type="text/javascript">
    window.location.href="./../head_create_read.php";
    </script>';

exit();

}

?>