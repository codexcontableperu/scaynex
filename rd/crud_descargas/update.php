<?php include("./../../data/conexion.php"); ?>

<?php
if (isset($_POST['guardar'])) {

  $idp = $_POST['idp'];
  $idr = $_POST['idr'];
  $idd = $_POST['idd'];
  $pe_cliente = $_POST['pe_cliente'];
  $desg_direccion = $_POST['desg_direccion'];
  $desg_distrito = $_POST['desg_distrito'];
  $hrcita = $_POST['hrcita'];
  $hora_cita = $_POST['hora_cita'];
  $prioridad= $_POST['prioridad'];
  $obs_descarga = $_POST['obs_descarga']; 
  $contacto = $_POST['contacto']; 
  $cont_telf = $_POST['cont_telf'];  

  //$h_llegadadestino = $_POST['h_llegadadestino'];
  //$h_entrega = $_POST['h_entrega'];
  //$t_entrega = $_POST['t_entrega'];
  //$h_salida = $_POST['h_salida'];
  //$t_espera = $h_entrega - $h_llegada;
  //$t_recepcion = $h_salida  - $h_entrega;
 

// Convert times to seconds
//$segundos_h_entrega = strtotime($h_entrega);
//$segundos_h_llegada = strtotime($h_llegadadestino);

// Calculate the difference in seconds
//$t_espera_segundos =  $segundos_h_entrega - $segundos_h_llegada  ;

// Convert the difference back to time format
//$t_espera = date("H:i:s", $t_espera_segundos);

//echo "La diferencia entre  t_espera es de $t_espera horas.";

// Convert times to seconds
//$segundos_h_salida = strtotime($h_salida);
//$segundos_h_entrega = strtotime($h_entrega);

// Calculate the difference in seconds
//$t_recepcion_segundos = $segundos_h_salida - $segundos_h_entrega;

// Convert the difference back to time format
//$t_recepcion = date("H:i:s", $t_recepcion_segundos);

//echo "La diferencia entre t_recepcion es de $t_recepcion horas.";

//echo $obs_descarga;
//die();

  $query = "UPDATE rd_descargas set

pe_cliente='$pe_cliente',
desg_direccion='$desg_direccion',
desg_distrito='$desg_distrito',
hrcita='$hrcita',
hora_cita='$hora_cita',
prioridad='$prioridad',
obs_descarga='$obs_descarga',
contacto='$contacto',
cont_telf='$cont_telf'

  WHERE  id_descaga=$idd";
  mysqli_query($conexion, $query);
}


mysqli_close($conexion);

 echo '<script type="text/javascript">
    window.location.href="./../wt_ruta_descargas.php?idp=' . $idp . '&idr=' . $idr . '&idd=' . $idd . '";
</script>';



exit();

?>