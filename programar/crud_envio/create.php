<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ARTICULOS---*/

if (isset($_POST['guardar'])) {



$c3=$_POST["fecha_registro"];
$c4=$_POST["id_user"];
$c5=1;
$c6=$_POST["importe"];
$c7="H";
$c8=$_POST["id_responsable"];
$c9=1;
$c10=0;
$c11=0;
$c12="efectivo a rendir" ." / ". $_POST["observacion"];
$c13="R";


$query= "INSERT INTO  ledger(  


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
estado

) VALUES (

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
'$c13'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);


/*---secion para msj ---*/

/*---redireccion ---*/
mysqli_close($conexion);	
echo'<script type="text/javascript">
    window.location.href="./../envio_fondos.php";
    </script>';

exit();

}

?>