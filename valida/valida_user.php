<?php include("./../data/conexion.php"); 




if (isset($_POST['guardar'])) {
	
	$dni = $_POST['dni'];

$query="SELECT * FROM usuarios WHERE user_dni= '$dni' ";
	$result=mysqli_query($conexion, $query);
	$numfilas = mysqli_num_rows($result);
	$filas=mysqli_fetch_assoc($result);
    $nick= $filas ['user_nick'];

if ($numfilas>0) {
@session_start();

$id_user=$filas ['id_user']; 
$_SESSION['usuario']=$nick;
$_SESSION['id_usuario']=$id_user;
$dniuser=$filas ['user_dni'];
$_SESSION['user_dni']=$dniuser;
$perfil = $filas ['user_perfil']; 


switch ($perfil) {

    case 2:
        ?><meta http-equiv="refresh" content="0;url=../rd/wt_prog_user.php?dni=' . $dni . '"/>';<?php
        break;
    case 3:
        ?><meta http-equiv="refresh" content="0;url=../rd/wt_prog_user.php?dni=' . $dni . '"/>';<?php
        break;
                 default:
                    echo "<script>
                            alert('Usuario no tiene permisos para acceder al sistema');
                            window.location.href = '../index.php';
                          </script>";
                    exit();
                    break;       
}


} else {
	mysqli_close($conexion);

echo "<script>alert('No  existe registro del DNI del usuario. Por favor, verifica o ingresa tu DNI correctamente.');</script>";

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