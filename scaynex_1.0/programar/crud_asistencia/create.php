<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ASISTENCIA---*/

if (isset($_POST['guardar'])) {
 $usuario = $_POST["id_responsable"];

      $queryp="SELECT usuarios.id_user, usuarios.user_salario, usuarios.user_hingreso 
FROM usuarios
WHERE (((usuarios.id_user)=$usuario))

";
$resultp=mysqli_query($conexion, $queryp);
$filasp=mysqli_fetch_assoc($resultp);
$salario = $filasp ['user_salario'];
$horaigreso = $filasp['user_hingreso'];

if (strlen($_POST["hora"]) == 5 ) {
    $horaasiste = $_POST["hora"].':00';
} else {
    $horaasiste = $_POST["hora"];
}

$hora1 = DateTime::createFromFormat('H:i:s', $horaigreso);
$hora2 = DateTime::createFromFormat('H:i:s', $horaasiste);




$diferencia = $hora1->diff($hora2);

$c2=$_POST["id_user"];
$c3=$_POST["fechacrea"];
$c4=$_POST["fechacrea"];
$c5=$_POST["hora"];
$c6=$_POST["placa"];
$c7=$salario;
$c8=$_POST["observacion"];
$c9=$_POST["id_responsable"];
$c10=$diferencia->format('%H:%I:%S');


$query= "INSERT INTO  asistencias(  

id_user,
fecha_reg,
fecha_asist,
hora_asist,
placa_asig,
salario,
obs_asist,
id_empleado,
tardanza 

) VALUES (

'$c2',
'$c3',
'$c4',
'$c5',
'$c6',
'$c7',
'$c8',
'$c9',
'$c10'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);


/*---secion para msj ---*/

/*---redireccion ---*/
mysqli_close($conexion);	
echo'<script type="text/javascript">
    window.location.href="./../asistencia.php";
    </script>';

}

?>