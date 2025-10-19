<?php include("./../../data/conexion.php"); ?>

<?php
if (isset($_POST['guardar'])) {
         $ID = $_POST['id'];
         $F = $_POST['FECHA'];           
         $EFEC = $_POST['EFECTIVO'];
         $YAPE = $_POST['YAPE'];
         $PLIN = $_POST['PLIN'];
         $OTRO = $_POST['OTROEF'];
         $TOTAL = $EFEC +$YAPE+$PLIN +$OTRO ;

  $query = "UPDATE rd_operadores set

EFECTIVO ='$EFEC',
YAPE ='$YAPE',
PLIN ='$PLIN',
OTROEF ='$OTRO',
TOTALEFECTIVO ='$TOTAL'

  WHERE ID_OPERA=$ID";

  mysqli_query($conexion, $query);

}


mysqli_close($conexion);

echo '<script type="text/javascript">
    window.location.href = "./../wt_form_operadores.php?f=' . $F . '";
</script>';



exit();

?>