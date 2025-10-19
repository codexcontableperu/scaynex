<?php include('../includes/header.php'); ?>
<?php include("./../../data/conexion.php"); ?>
<?php 

$idp=$_GET['idp'];
$i=$_GET['i'];

switch ($i) {

    case 200:
   
          $query = "UPDATE rd_inicio_fin set HORA_SALIDA_BASE = '$horaa' WHERE Id_SERG ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);

        break;

    case 2200:
    
          $query = "UPDATE rd_inicio_fin set TEMP_SALIDA_BASE = '00.0' WHERE Id_SERG ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);

        break;

    case 2000:
          $query = "UPDATE rd_inicio_fin set KM_SALIDA_BASE = '00.0' WHERE Id_SERG ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;


    case 800:
          $query = "UPDATE rd_inicio_fin set HORA_LLEGADA_BASE = '$horaa' WHERE Id_SERG ='$idp'";
          mysqli_query($conexion, $query);

$queryD="
SELECT HORA_LLEGADA_BASE, HORA_SALIDA_BASE   FROM rd_inicio_fin WHERE Id_SERG=$idp";
$resultD=mysqli_query($conexion, $queryD);
$filasD=mysqli_fetch_assoc($resultD);
$LLEGADA_BASE=$filasD['HORA_LLEGADA_BASE'];
$SALIDA_BASE=$filasD['HORA_SALIDA_BASE'];

// Convert times to seconds
$segundos_h_llegada = strtotime($LLEGADA_BASE);
$segundos_h_salida= strtotime($SALIDA_BASE);


// Calculate the difference in seconds
$recorrido_segundos = $segundos_h_llegada - $segundos_h_salida;


// Calcular horas y minutos
$horas_recorrido = floor($recorrido_segundos / 3600);  // 1 hora = 3600 segundos
$minutos_recorrido = floor(($recorrido_segundos % 3600) / 60);  // Resto dividido por 60 para obtener los minutos

// Formatear el resultado
$hr_recorrido = $horas_recorrido . 'h ' . str_pad($minutos_recorrido, 2, '0', STR_PAD_LEFT) . 'm';

            $query = "UPDATE rd_inicio_fin set hr_recorrido = '$hr_recorrido' WHERE Id_SERG ='$idp'";
            mysqli_query($conexion, $query);



          mysqli_close($conexion);        
          break;

    case 8800:
          $query = "UPDATE rd_inicio_fin set TEMP_LLEGADA_BASE = '00.0'WHERE Id_SERG ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;

    case 8000:
          $query = "UPDATE rd_inicio_fin set KM_LLEGADA_BASE = '100.0'WHERE Id_SERG ='$idp'";
          mysqli_query($conexion, $query);

$queryKR="SELECT KM_LLEGADA_BASE, KM_SALIDA_BASE FROM rd_inicio_fin WHERE Id_SERG=$idp";
$resultKR=mysqli_query($conexion, $queryKR);
$filasKR=mysqli_fetch_assoc($resultKR);
$KM_LLEGADA=$filasKR ['KM_LLEGADA_BASE'];
$KM_SALIDA=$filasKR ['KM_SALIDA_BASE'];
$KM_RECORRIDO=$KM_LLEGADA-$KM_SALIDA;

          $query = "UPDATE rd_inicio_fin set km_recorrido = '$KM_RECORRIDO' WHERE Id_SERG ='$idp'";
          mysqli_query($conexion, $query);

          mysqli_close($conexion);
          break;
          
    case 1:
          $query = "UPDATE rd_inicio_fin set wt_inicio = 'si' WHERE Id_SERG ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);  
 ?>   
<meta http-equiv="refresh" 
      content="0;url=../crud_mensajes/msj_inicio.php?idp=<?php echo $idp?> " />
<?php     
          die();  
          break;

    case 9:
          $query = "UPDATE rd_inicio_fin set wt_fin = 'si' WHERE Id_SERG ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          
 ?>   
<meta http-equiv="refresh" 
      content="0;url=../crud_mensajes/msj_fin.php?idp=<?php echo $idp?> " />
<?php
          die();
          break;
          
}

 ?>


 <meta http-equiv="refresh" content="0;url=./../wt_panel_user.php?idp=<?php echo $idp ?>" />
