<?php include("../../data/conexion.php"); 

if (isset($_POST['guardar'])) {
    $tabla = $_POST['tabla'];
    $RD = $_POST['Id_SERG'];

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
echo $query;

    // Ejecutar la consulta
    $result = mysqli_query($conexion, $query);

    if ($result) {
        // Éxito: redireccionar a la página de lectura
        mysqli_close($conexion);
        echo '<script type="text/javascript">
            window.location.href="./../' . $tabla . '_read.php?rd=' . $RD. '";
        </script>';
        exit();
    } else {
        // Error en la consulta
        echo "Error al insertar el registro: " . mysqli_error($conexion);
    }
}
?>




