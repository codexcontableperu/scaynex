<?php include("./../../data/conexion.php"); ?>

<?php
if (isset($_POST['guardar'])) {
  $RD = $_POST['Id_SERG'];
  $OP= $_POST['ID_OPERA'];
  $ID= $_POST['ID_D'];
  $IMPORTE= $_POST['IMPORTE'];
  $GLOSA = $_POST['GLOSA'];
if ($GLOSA == "") {
   $GLOSA = 'Etrega a rendir';
} else {
   $GLOSA = $_POST['GLOSA'];
};


  // CONSULTA DE FECHA DE REGISTROS DE DIARIO
  $query = "
  SELECT diario.ID_DIARIO, diario.FECHA_R
FROM diario
WHERE (((diario.ID_DIARIO)='$ID'));
  ";
  $result = mysqli_query($conexion, $query);
  $filas=mysqli_fetch_assoc($result);
  $FR=$filas ['FECHA_R'];

  $query = "UPDATE diario set
    IMPORTE='$IMPORTE',
    DEBE=0,
    HABER='$IMPORTE',
    SALDO='$IMPORTE'*-1,
    GLOSA='$GLOSA'
  WHERE  DH = 'H' and FECHA_R='$FR'";
  mysqli_query($conexion, $query);

  $query = "UPDATE diario set
    IMPORTE='$IMPORTE',
    DEBE='$IMPORTE',
    HABER=0,
    SALDO='$IMPORTE',
    GLOSA='$GLOSA'
  WHERE  DH = 'D' and FECHA_R='$FR'";
  mysqli_query($conexion, $query);
}


mysqli_close($conexion);

 echo '<script type="text/javascript">
    window.location.href="./../rd_diario_arendir.php?op=' . $OP . '&rd=' . $RD . '";
</script>';



exit();

?>