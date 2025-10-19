<?php include("./../../data/conexion.php"); ?>
<?php 
if (isset($_POST['guardar'])) {
    $idp= $_POST['Id_SERG'];
$tabla = 'rd_servicio';
    // Obtener la estructura de la tabla
    $query = "DESCRIBE $tabla";
    $result = mysqli_query($conexion, $query);

    $columns = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $columns[] = $row["Field"];
    }

    // Obtener los valores de los campos del formulario
    $values = array();
    foreach ($columns as $campo) {
        if (isset($_POST[$campo])) {
            $values[] = "'" . mysqli_real_escape_string($conexion, $_POST[$campo]) . "'";
        } else {
            $values[] = "NULL";
        }
    }
    
    // Crear la consulta para la inserción
    $query = "INSERT INTO $tabla (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ")";

    // Ejecutar la consulta
   $result = mysqli_query($conexion, $query);



   mysqli_close($conexion);
        echo '<script type="text/javascript">
            window.location.href="./../wt_panel_user.php?idp=' . $idp. '";
        </script>';

     }?>