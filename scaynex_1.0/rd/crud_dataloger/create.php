<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ASISTENCIA---*/

if (isset($_POST['guardar'])) {

    $ID_SERV = $_POST["idr"];
    $dt_fecha = $_POST["dt_fecha"];
    $dt_cuenta = $_POST["dt_cuenta"];
    $dt_cliente = $_POST["dt_cliente"];
    $dt_guia = $_POST["dt_guia"];
    $dt_factura = $_POST["dt_factura"];
    $dt_codigo = $_POST["dt_codigo"];
    $dt_cantidad = $_POST["dt_cantidad"];
    $dt_placa = $_POST["dt_placa"];

    $idr = $_POST["idr"];
    $idp = $_POST["idp"];

$query= "INSERT INTO  rd_dataloger(  

ID_SERV,
dt_fecha,
dt_cuenta,
dt_cliente,
dt_guia,
dt_factura,
dt_codigo,
dt_cantidad, 
dt_placa

) VALUES (

'$ID_SERV',
'$dt_fecha',
'$dt_cuenta',
'$dt_cliente',
'$dt_guia',
'$dt_factura',
'$dt_codigo',
'$dt_cantidad',
'$dt_placa'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);


  $query = "UPDATE rd_servicio set DATALOGGER  ='SI'  WHERE  ID_SERV ='$idr'";
  mysqli_query($conexion, $query);



/*---secion para msj ---*/

/*---redireccion ---*/
mysqli_close($conexion);	
echo '<script type="text/javascript">
    window.location.href="./../wt_ruta_ruta.php?idp=' . $idp . '&idr=' . $idr . '";
</script>';

}

?>