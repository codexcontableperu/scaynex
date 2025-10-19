<?php include("./../../data/conexion.php"); ?>
<?php include('../includes/session.php'); ?>
<?php 

/*---NEW ASISTENCIA---*/

if (isset($_POST['guardar'])) {

  $RD = $_POST['Id_SERG'];
  $OP= $_POST['ID_OPERA'];
  $CTA = $_POST['CTA_CONT'];
  $IMPORTE= $_POST['importe'];
  $GLOSA = $_POST['GLOSA'];
if ($GLOSA == "") {
   $GLOSA = 'Registro de gasto realizado';
} else {
   $GLOSA = $_POST['GLOSA'];
};

$DH ='D';
$DEBE = $IMPORTE;
$HABER = 0;
$SALDO = $IMPORTE ;
$R_USER = $id_userup;

$ANEXO= $_POST['ANEXO'];
$KILOMETRAJE= $_POST['KILOMETRAJE'];
$MEDIDA= $_POST['MEDIDA'];
$CANTIDAD= $_POST['CANTIDAD'];
$TIPO_DOC= $_POST['TIPO_DOC'];
$NRO_DOC= $_POST['NRO_DOC'];
$FECHA_DOC= $_POST['FECHA_DOC'];



$query= "INSERT INTO  diario(  

ID_OPERA,
Id_SERG,
CTA_CONT,
DH,
IMPORTE,
DEBE,
HABER,
SALDO,
FECHA_DOC,
R_USER,
GLOSA,
ANEXO,
KILOMETRAJE,
MEDIDA,
CANTIDAD,
TIPO_DOC,
NRO_DOC


) VALUES (

'$OP',
'$RD',
'$CTA',
'$DH',
'$IMPORTE',
'$DEBE',
'$HABER',
'$SALDO',
'$FECHA_DOC',
'$R_USER',
'$GLOSA',
'$ANEXO',
'$KILOMETRAJE',
'$MEDIDA',
'$CANTIDAD',
'$TIPO_DOC',
'$NRO_DOC'

)";

/*---create ---*/
$result = mysqli_query($conexion, $query);

$CTA2 = 1413;
$DH2 ='H';
$DEBE2 = 0;
$HABER2 = $IMPORTE;
$SALDO2 = $IMPORTE * -1 ;

$query= "INSERT INTO  diario(  

ID_OPERA,
Id_SERG,
CTA_CONT,
DH,
IMPORTE,
DEBE,
HABER,
SALDO,
FECHA_DOC,
R_USER,
GLOSA,
ANEXO,
KILOMETRAJE,
MEDIDA,
CANTIDAD,
TIPO_DOC,
NRO_DOC

) VALUES (

'$OP',
'$RD',
'$CTA2',
'$DH2',
'$IMPORTE',
'$DEBE2',
'$HABER2',
'$SALDO2',
'$FECHA_DOC',
'$R_USER',
'$GLOSA',
'$ANEXO',
'$KILOMETRAJE',
'$MEDIDA',
'$CANTIDAD',
'$TIPO_DOC',
'$NRO_DOC'

)";

/*---create ---*/
$result = mysqli_query($conexion, $query);

/*---secion para msj ---*/

/*---redireccion ---*/
mysqli_close($conexion);	

 echo '<script type="text/javascript">
    window.location.href="./../rd_diario_nuevogasto.php?op=' . $OP . '&rd=' . $RD . '";
</script>';


}

?>