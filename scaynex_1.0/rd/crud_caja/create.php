<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ASISTENCIA---*/

if (isset($_POST['guardar'])) {

$idp = $_POST["idp"];
$id_user = $_POST["id_user"];
$id_concepto = 1;
$importe = $_POST["importe"];
$tipo_dh = 'H';
$id_responsable = $_POST["id_responsable"];
$observacion = $_POST["observacion"];

$query= "INSERT INTO  ledger(  

id_user,
id_concepto,
importe,
tipo_dh,
id_responsable,
observacion,
IDP


) VALUES (

'$id_user',
'$id_concepto',
'$importe',
'$tipo_dh',
'$id_responsable',
'$observacion',
'$idp'


)";

/*---create ---*/
$result = mysqli_query($conexion, $query);


  $query = "UPDATE rd_inicio_fin set ARENDIR  ='$importe'  WHERE  Id_SERG ='$idp'";
  mysqli_query($conexion, $query);



/*---secion para msj ---*/

/*---redireccion ---*/
mysqli_close($conexion);	
echo '<script type="text/javascript">
    window.location.href="./../wt_panel_user.php?idp=' . $idp . '";
</script>';


}

?>