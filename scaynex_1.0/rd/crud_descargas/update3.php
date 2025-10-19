<?php include('../includes/header.php'); ?>
<?php include("./../../data/conexion.php"); ?>


<?php 

$idp=$_POST['idp'];
$idr=$_POST['idr'];
$idd=$_POST['idd'];
$i=$_POST['i'];
$txt=$_POST['txt'];


switch ($i) {
    case 4:

          $query = "UPDATE rd_descargas set h_llegadadestino = '$txt' WHERE id_descaga ='$idd'";
          mysqli_query($conexion, $query);

$queryD="
SELECT h_entrega, h_llegadadestino  , h_salida FROM rd_descargas WHERE id_descaga=$idd";
$resultD=mysqli_query($conexion, $queryD);
$filasD=mysqli_fetch_assoc($resultD);

if ($filasD['h_entrega']===null) {
  $h_entrega='0';
} else {
  $h_entrega=$filasD['h_entrega'];
}

if ($filasD['h_llegadadestino']===null) {
  $h_llegadadestino='0';
} else {
  $h_llegadadestino=$filasD['h_llegadadestino'];
}

if ($filasD['h_salida']===null) {
  $h_salida='0';
} else {
  $h_salida=$filasD['h_salida'];
}


// Convert times to seconds
$segundos_h_entrega = strtotime($h_entrega);
$segundos_h_llegada = strtotime($h_llegadadestino);

// Calculate the difference in seconds
$t_espera_segundos =  $segundos_h_entrega - $segundos_h_llegada  ;


// Calcular horas y minutos
$horas_espera = floor($t_espera_segundos / 3600);  // 1 hora = 3600 segundos
$minutos_espera = floor(($t_espera_segundos % 3600) / 60);  // Resto dividido por 60 para obtener los minutos

// Formatear el resultado
$t_espera = $horas_espera . 'h ' . str_pad($minutos_espera, 2, '0', STR_PAD_LEFT) . 'm';



// Convert the difference back to time format
//$t_espera = date("H:i:s", $t_espera_segundos);
//$t_espera =  $t_espera_segundos;
//echo "La diferencia entre  t_espera es de $t_espera horas.";

// Convert times to seconds
$segundos_h_salida = strtotime($h_salida);
$segundos_h_entrega = strtotime($h_entrega );

// Calculate the difference in seconds
$t_recepcion_segundos = $segundos_h_salida - $segundos_h_entrega;


// Calcular horas y minutos
$horas_recepcion = floor($t_recepcion_segundos / 3600);  // 1 hora = 3600 segundos
$minutos_recepcion = floor(($t_recepcion_segundos % 3600) / 60);  // Resto dividido por 60 para obtener los minutos

// Formatear el resultado
$t_recepcion = $horas_recepcion . 'h ' . str_pad($minutos_recepcion, 2, '0', STR_PAD_LEFT) . 'm';

// Convert the difference back to time format
//$t_recepcion = date("H:i:s", $t_recepcion_segundos);
//$t_recepcion = $t_recepcion_segundos;
  //$t_espera = $h_entrega - $h_llegada;
  //$t_recepcion = $h_salida  - $h_entrega;

            $query = "UPDATE rd_descargas set t_espera = '$t_espera', t_recepcion = '$t_recepcion' WHERE id_descaga ='$idd'";
            mysqli_query($conexion, $query);

          mysqli_close($conexion);

        break;
    case 3:

          $query = "UPDATE rd_descargas set h_entrega = '$txt' WHERE id_descaga ='$idd'";
          mysqli_query($conexion, $query);
$queryD="
SELECT h_entrega, h_llegadadestino  , h_salida FROM rd_descargas WHERE id_descaga=$idd";
$resultD=mysqli_query($conexion, $queryD);
$filasD=mysqli_fetch_assoc($resultD);

if ($filasD['h_entrega']===null) {
  $h_entrega='0';
} else {
  $h_entrega=$filasD['h_entrega'];
}

if ($filasD['h_llegadadestino']===null) {
  $h_llegadadestino='0';
} else {
  $h_llegadadestino=$filasD['h_llegadadestino'];
}

if ($filasD['h_salida']===null) {
  $h_salida='0';
} else {
  $h_salida=$filasD['h_salida'];
}


// Convert times to seconds
$segundos_h_entrega = strtotime($h_entrega);
$segundos_h_llegada = strtotime($h_llegadadestino);

// Calculate the difference in seconds
$t_espera_segundos =  $segundos_h_entrega - $segundos_h_llegada  ;


// Calcular horas y minutos
$horas_espera = floor($t_espera_segundos / 3600);  // 1 hora = 3600 segundos
$minutos_espera = floor(($t_espera_segundos % 3600) / 60);  // Resto dividido por 60 para obtener los minutos

// Formatear el resultado
$t_espera = $horas_espera . 'h ' . str_pad($minutos_espera, 2, '0', STR_PAD_LEFT) . 'm';



// Convert the difference back to time format
//$t_espera = date("H:i:s", $t_espera_segundos);
//$t_espera =  $t_espera_segundos;
//echo "La diferencia entre  t_espera es de $t_espera horas.";

// Convert times to seconds
$segundos_h_salida = strtotime($h_salida);
$segundos_h_entrega = strtotime($h_entrega );

// Calculate the difference in seconds
$t_recepcion_segundos = $segundos_h_salida - $segundos_h_entrega;


// Calcular horas y minutos
$horas_recepcion = floor($t_recepcion_segundos / 3600);  // 1 hora = 3600 segundos
$minutos_recepcion = floor(($t_recepcion_segundos % 3600) / 60);  // Resto dividido por 60 para obtener los minutos

// Formatear el resultado
$t_recepcion = $horas_recepcion . 'h ' . str_pad($minutos_recepcion, 2, '0', STR_PAD_LEFT) . 'm';

// Convert the difference back to time format
//$t_recepcion = date("H:i:s", $t_recepcion_segundos);
//$t_recepcion = $t_recepcion_segundos;
  //$t_espera = $h_entrega - $h_llegada;
  //$t_recepcion = $h_salida  - $h_entrega;

            $query = "UPDATE rd_descargas set t_espera = '$t_espera', t_recepcion = '$t_recepcion' WHERE id_descaga ='$idd'";
            mysqli_query($conexion, $query);

          mysqli_close($conexion);

        break;  
    case 2:

          $query = "UPDATE rd_descargas set temp_entrega = '$txt' WHERE id_descaga ='$idd'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);

        break;               
    case 1:

          $query = "UPDATE rd_descargas set h_salida = '$txt' WHERE id_descaga ='$idd'";
          mysqli_query($conexion, $query);

$queryD="
SELECT h_entrega, h_llegadadestino  , h_salida FROM rd_descargas WHERE id_descaga=$idd";
$resultD=mysqli_query($conexion, $queryD);
$filasD=mysqli_fetch_assoc($resultD);

if ($filasD['h_entrega']===null) {
  $h_entrega='0';
} else {
  $h_entrega=$filasD['h_entrega'];
}

if ($filasD['h_llegadadestino']===null) {
  $h_llegadadestino='0';
} else {
  $h_llegadadestino=$filasD['h_llegadadestino'];
}

if ($filasD['h_salida']===null) {
  $h_salida='0';
} else {
  $h_salida=$filasD['h_salida'];
}


// Convert times to seconds
$segundos_h_entrega = strtotime($h_entrega);
$segundos_h_llegada = strtotime($h_llegadadestino);

// Calculate the difference in seconds
$t_espera_segundos =  $segundos_h_entrega - $segundos_h_llegada  ;


// Calcular horas y minutos
$horas_espera = floor($t_espera_segundos / 3600);  // 1 hora = 3600 segundos
$minutos_espera = floor(($t_espera_segundos % 3600) / 60);  // Resto dividido por 60 para obtener los minutos

// Formatear el resultado
$t_espera = $horas_espera . 'h ' . str_pad($minutos_espera, 2, '0', STR_PAD_LEFT) . 'm';



// Convert the difference back to time format
//$t_espera = date("H:i:s", $t_espera_segundos);
//$t_espera =  $t_espera_segundos;
//echo "La diferencia entre  t_espera es de $t_espera horas.";

// Convert times to seconds
$segundos_h_salida = strtotime($h_salida);
$segundos_h_entrega = strtotime($h_entrega );

// Calculate the difference in seconds
$t_recepcion_segundos = $segundos_h_salida - $segundos_h_entrega;


// Calcular horas y minutos
$horas_recepcion = floor($t_recepcion_segundos / 3600);  // 1 hora = 3600 segundos
$minutos_recepcion = floor(($t_recepcion_segundos % 3600) / 60);  // Resto dividido por 60 para obtener los minutos

// Formatear el resultado
$t_recepcion = $horas_recepcion . 'h ' . str_pad($minutos_recepcion, 2, '0', STR_PAD_LEFT) . 'm';

// Convert the difference back to time format
//$t_recepcion = date("H:i:s", $t_recepcion_segundos);
//$t_recepcion = $t_recepcion_segundos;
  //$t_espera = $h_entrega - $h_llegada;
  //$t_recepcion = $h_salida  - $h_entrega;

            $query = "UPDATE rd_descargas set t_espera = '$t_espera', t_recepcion = '$t_recepcion' WHERE id_descaga ='$idd'";
            mysqli_query($conexion, $query);

            mysqli_close($conexion);        
            break;
}

 ?>



<meta http-equiv="refresh" content="0;url=./../wt_ruta_descargas.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>&idd=<?php echo $idd ?>" />
