<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ARTICULOS---*/

if (isset($_POST['guardar'])) {
    // Obtener datos del formulario
    $idp = $_POST['idp'];
    $idr = $_POST['idr'];
    $gt_servicio = $_POST['idr'];
    $gt_observ = $_POST['gt_observ'];
    $gt_solicita = $_POST['gt_solicita'];
    $gt_estado = 'Pendiente';

    // Construir la consulta SQL
    $query = "
        INSERT INTO guias_transp (

            gt_servicio,
            gt_observ,
            gt_solicita,
            gt_estado
        ) VALUES (

            '$gt_servicio',
            '$gt_observ',
            '$gt_solicita',
            '$gt_estado'
        )
    ";
/*---create ---*/
$result = mysqli_query($conexion, $query);


                   $query = "UPDATE hruta set GUIA_TRANSP = 'SI' WHERE id_serv ='$idr'"; 
                   mysqli_query($conexion, $query);

}

?> 

<meta http-equiv="refresh" content="0;url=./../wt_ruta_ruta.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>" /><?php
