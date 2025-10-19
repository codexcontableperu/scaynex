<?php include("./../../data/conexion.php"); ?>

<?php
if (isset($_POST['guardar'])) {

    $id_dt = $_POST["id_dt"];

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
 


  $query = "UPDATE rd_dataloger set

        dt_fecha = '$dt_fecha',
        dt_cuenta = '$dt_cuenta',
        dt_cliente = '$dt_cliente',
        dt_guia = '$dt_guia',
        dt_factura = '$dt_factura',
        dt_codigo = '$dt_codigo',
        dt_cantidad = '$dt_cantidad',
        dt_placa = '$dt_placa'

  WHERE  id_dt=$id_dt";
  mysqli_query($conexion, $query);
}


mysqli_close($conexion);

echo '<script type="text/javascript">
    window.location.href="./../wt_ruta_dataloger.php?idp=' . $idp . '&idr=' . $idr . '&id=' . $id_dt . '";
</script>';


?>