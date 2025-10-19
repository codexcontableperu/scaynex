<?php include("./../../data/conexion.php"); ?>

<?php
if (isset($_POST['guardar'])) {
         $ID = $_POST['id'];
         $RD = $_POST['Id_SERG'];
         $EFEC = $_POST['EFECTIVO'];
         if ($EFEC>0) {
           $EFEC = $_POST['EFECTIVO'];
         } else {
           $EFEC = 0.00;
         };
         
         $YAPE = $_POST['YAPE'];
                  if ($YAPE>0) {
           $YAPE = $_POST['EFECTIVO'];
         } else {
           $YAPE = 0.00;
         };
         $PLIN = $_POST['PLIN'];
                  if ($PLIN>0) {
           $PLIN = $_POST['EFECTIVO'];
         } else {
           $PLIN = 0.00;
         };
         $OTRO = $_POST['OTROEF'];
                  if ($OTRO>0) {
           $OTRO = $_POST['EFECTIVO'];
         } else {
           $OTRO = 0.00;
         };
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
            window.location.href="./../rd_operadores_read.php?rd=' . $RD. '";
        </script>';


exit();

?>