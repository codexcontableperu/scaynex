<?php include("./../../data/conexion.php"); ?>

<?php


if (isset($_POST['guardar'])) {


         $ID_PLL = $_POST['ID_PLL'];
         $EPS = $_POST['EPS'];
         $PLACA = $_POST['PLACA']; 
         $TEMPERATURA = $_POST['TEMPERATURA'];
         $CONDUCTOR = $_POST['CONDUCTOR'];          
         $AUXILIAR1 = $_POST['AUXILIAR1'];
         $AUXILIAR2 = $_POST['AUXILIAR2'];
         $AUXILIAR3 = $_POST['AUXILIAR3'];
         $CLIENTE = $_POST['CLIENTE'];
         $SERVICIOS = $_POST['SERVICIOS'];
         $HCITA = $_POST['HCITA'];
//echo  $PLACA;

//Die();
  $query = "UPDATE rd_segimientos_pll set

PLACA ='$PLACA',
TEMPERATURA ='$TEMPERATURA',
CONDUCTOR ='$CONDUCTOR',
AUXILIAR1 ='$AUXILIAR1',
AUXILIAR2 ='$AUXILIAR2',
AUXILIAR3 ='$AUXILIAR3',
SERVICIOS ='$SERVICIOS',
ID_CLIENTE ='$CLIENTE',
H_CITA ='$HCITA',
EPS ='$EPS'

  WHERE Id_pll=$ID_PLL";

  mysqli_query($conexion, $query);

}


mysqli_close($conexion);


            echo '<script type="text/javascript">
                window.location.href="./../plantilla_read.php";
            </script>';



exit();

?>