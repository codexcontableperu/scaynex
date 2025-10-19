<?php include("./../../data/conexion.php"); 



if (isset($_POST['usuario'])) {
	
	$dni = $_POST['usuario'];
	$clave = $_POST['pass'];

$query="SELECT * FROM usuarios WHERE user_dni= '$dni' and user_clave= '$clave'";
	$result=mysqli_query($conexion, $query);
	$numfilas = mysqli_num_rows($result);
	$filas=mysqli_fetch_assoc($result);
    $nick= $filas ['user_nick'];


if ($numfilas>0) {

@session_start();

$id_user=$filas ['id_user']; 
$_SESSION['usuario']=$nick;
$_SESSION['id_usuario']=$id_user;


	echo'<script type="text/javascript">
    window.location.href="./../home.php";
    </script>';
mysqli_close($conexion);
exit();


} else {
	mysqli_close($conexion);
	echo'<script type="text/javascript">
    window.location.href="./../index.php";
    </script>';


}


} else {
	mysqli_close($conexion);
	echo'<script type="text/javascript">
    window.location.href="./../index.php";
    </script>';


die();
}

?>