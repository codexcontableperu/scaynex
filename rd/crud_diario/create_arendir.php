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
   $GLOSA = 'Etrega a rendir';
} else {
   $GLOSA = $_POST['GLOSA'];
};

$DH ='H';
$DEBE = 0;
$HABER = $IMPORTE;
$SALDO = $IMPORTE * -1;
$FECHA_DOC = $FECHAW;
$R_USER = $id_userup;

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
GLOSA
 

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
'$GLOSA'

)";

/*---create ---*/
$result = mysqli_query($conexion, $query);

$CTA2 = 1413;
$DH2 ='D';
$DEBE2 = $IMPORTE;
$HABER2 = 0;
$SALDO2 = $IMPORTE ;

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
GLOSA
 

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
'$GLOSA'

)";

/*---create ---*/
$result = mysqli_query($conexion, $query);

/*---secion para msj ---*/

/*---redireccion ---*/
mysqli_close($conexion);	

 echo '<script type="text/javascript">
    window.location.href="./../rd_diario_arendir.php?op=' . $OP . '&rd=' . $RD . '";
</script>';


}

?>