<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ASISTENCIA---*/

if (isset($_POST['guardar'])) {

         $PLACA = $_POST['PLACA']; 
         $CONDUCTOR = $_POST['CONDUCTOR'];          
         $AUXILIAR1 = $_POST['AUXILIAR1'];
         $AUXILIAR2 = $_POST['AUXILIAR2'];
         $AUXILIAR3 = $_POST['AUXILIAR3'];
         $SERVICIOS = $_POST['SERVICIOS'];
         $CLIENTE = $_POST['CLIENTE'];         
         $HCITA = $_POST['HCITA'];
         $EPS = $_POST['EPS'];         

$query= "INSERT INTO  rd_segimientos_pll(  


PLACA,
CONDUCTOR,
AUXILIAR1,
AUXILIAR2,
AUXILIAR3,
SERVICIOS,
ID_CLIENTE,
H_CITA, 
EPS

) VALUES (

'$PLACA',
'$CONDUCTOR',
'$AUXILIAR1',
'$AUXILIAR2',
'$AUXILIAR3',
'$SERVICIOS',
'$CLIENTE',
'$HCITA',
'$EPS'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);


/*---secion para msj ---*/

/*---redireccion ---*/
mysqli_close($conexion);	
echo'<script type="text/javascript">
    window.location.href="./../rd_plantilla_read.php";
    </script>';

}

?>