<?php include("./../../data/conexion.php"); ?>

<?php

if (isset($_POST['guardar'])) {

    // Recibir los datos del formulario
    $S_USER = mysqli_real_escape_string($conexion, trim($_POST['S_USER'])); // Eliminar espacios al inicio y final
    $S_FECHA = mysqli_real_escape_string($conexion, $_POST['S_FECHA']);
    $CODIGO = mysqli_real_escape_string($conexion, $_POST['CODIGO']);

    // Limpiar el código SQL de caracteres especiales y saltos de línea
    $CODIGO = str_replace(array("\\r", "\\n", "\r", "\n"), '', $CODIGO); // Eliminar saltos de línea
    $CODIGO = preg_replace("/\s+/", ' ', $CODIGO); // Reemplazar múltiples espacios por uno solo
    $CODIGO = trim($CODIGO); // Eliminar espacios al inicio y final
    $CODIGO = stripslashes($CODIGO); // Eliminar comillas escapadas innecesarias

    // Eliminar la cadena de encabezado de $CODIGO y el primer carácter
    if (strpos($CODIGO, "VALUES") !== false) {
        $CODIGO = substr($CODIGO, strpos($CODIGO, "VALUES") + 6); // Eliminar la parte de "VALUES"
        $CODIGO = substr($CODIGO, 2); // Eliminar el primer carácter
    }

    // Estructura fija de la consulta SQL
    $sql_base = "INSERT INTO rd_segimientos_head (EPS, TEMPERATURA, PLACA, CONDUCTOR, AUXILIAR1, AUXILIAR2, AUXILIAR3, RESGUARDO, TIPO_DESPACHO, SERVICIOS, ID_CLIENTE, H_CITA, H_CITA_R, OBS_PROG, S_USER, S_FECHA) VALUES ";

    // Manejar múltiples registros
    $valores = explode("),(", $CODIGO);
    $valores_modificados = [];
    foreach ($valores as $index => $valor) {
        // Eliminar paréntesis adicionales y añadir los valores de S_USER y S_FECHA
        $valor = trim($valor, "()");
        $valor = $valor . ", '" . trim($S_USER) . "', '$S_FECHA'"; // Eliminar espacios adicionales de S_USER
        $valores_modificados[] = "($valor)"; // Añadir paréntesis aquí
    }
    $CODIGO_MODIFICADO = $sql_base . implode(", ", $valores_modificados); // Concatenar valores modificados sin paréntesis adicionales

    // Limpiar el código SQL modificado
    $CODIGO_MODIFICADO = str_replace(array("\\r", "\\n", "\r", "\n"), '', $CODIGO_MODIFICADO); // Eliminar saltos de línea
    $CODIGO_MODIFICADO = preg_replace("/\s+/", ' ', $CODIGO_MODIFICADO); // Reemplazar múltiples espacios por uno solo
    $CODIGO_MODIFICADO = trim($CODIGO_MODIFICADO); // Eliminar espacios al inicio y final
    $CODIGO_MODIFICADO = stripslashes($CODIGO_MODIFICADO); // Eliminar comillas escapadas innecesarias

    // Imprimir la consulta para verificar antes de ejecutarla (solo para pruebas)
    echo "<pre>$CODIGO_MODIFICADO</pre>";

    // Ejecutar el código SQL modificado
    if ($conexion->query($CODIGO_MODIFICADO) === TRUE) {
        echo "El registro fue insertado correctamente.";
    } else {
        echo "Error al ejecutar el código SQL: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
             echo '<script type="text/javascript">
    window.location.href="./../programacion.php?f=' . $S_FECHA . '";
</script>';
}

?>
