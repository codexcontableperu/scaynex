<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ARTICULOS---*/

if (isset($_POST['guardar'])) {

$c2=$_POST["fechacrea"];
$c3=$_POST["fecha_registro"];
$c4=$_POST["id_user"];
$c5=2;
$c6=$_POST["salario"]*-1;
$c7="D";
$c8=$_POST["id_user"];
$c9=6;
$c10=0;
$c11=0;
$c12=$_POST["observacion"];
$c13="R";
$c14=$_POST["salario"];


$query= "INSERT INTO  ledger(  

fecha_creacion,
fecha_registro,
id_user,
id_concepto,
importe,
tipo_dh,
id_responsable,
tipo_doc,
num_doc,
kilometraje,
observacion,
estado,
salario

) VALUES (
'$c2',
'$c3',
'$c4',
'$c5',
'$c6',
'$c7',
'$c8',
'$c9',
'$c10',
'$c11',
'$c12',
'$c13',
'$c14'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);


/*---secion para msj ---*/

/*---redireccion ---*/



}

?>

<meta http-equiv="refresh" content="0;url=./../rendiciones.php" />