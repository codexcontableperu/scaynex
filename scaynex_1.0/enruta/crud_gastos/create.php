<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ARTICULOS---*/

if (isset($_POST['guardar'])) {

$c2=$_POST["fechacrea"];
$c3=$_POST["fecha_registro"];
$c4=$_POST["id_user"];
$c5=$_POST["Concepto"];
$c6=$_POST["importe"]*-1;
$c7="D";
$c8=$_POST["id_user"];
$c9=$_POST["tipo_doc"];
$c10=$_POST["documento"];
$c11=$_POST["kilometraje"];
$c12=$_POST["observacion"];
$c13="R";
$c15=$_POST["placa"];
$c16=$_POST["gls"];
$c17=$_POST["proveedor"];


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
id_unidad,
id_gls, 
id_provvedor

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
'$c15',
'$c16',
'$c17'

)";

/*---create ---*/
$result = mysqli_query($conexion, $query);


/*---secion para msj ---*/

/*---redireccion ---*/



}

?>

<meta http-equiv="refresh" content="0;url=./../rendiciones.php" />