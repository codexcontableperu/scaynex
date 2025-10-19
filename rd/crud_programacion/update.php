<?php 
include("../../data/conexion.php"); 

if (isset($_POST['Id_SERG'])) {
    $FECHA = $_POST['S_FECHA'];
    $ID = $_POST['Id_SERG'];
    $tabla = 'rd_segimientos_head';

    // Obtener la estructura de la tabla
    $query = "DESCRIBE $tabla";
    $result = mysqli_query($conexion, $query);

    $estructura = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $estructura[] = $row;
    }

    // Obtener la columna de clave primaria
    $indice = '';
    foreach ($estructura as $row) {
        if ($row['Key'] === 'PRI') {
            $indice = $row['Field'];
            break;
        }
    }

    // Construir la parte SET
    $set_values = '';
    foreach ($estructura as $row) {
        $campo = $row['Field'];
        if ($campo !== $indice) {
            $valor = isset($_POST[$campo]) ? mysqli_real_escape_string($conexion, $_POST[$campo]) : NULL;
            $set_values .= "$campo = " . ($valor !== NULL ? "'$valor'" : "NULL") . ", ";
        }
    }
    $set_values = rtrim($set_values, ', ');

    // Actualizar la tabla principal
    $query = "UPDATE $tabla SET $set_values WHERE $indice = '$ID'";
    mysqli_query($conexion, $query);

    // Capturar operadores si existen
    $CONDUCTOR  = isset($_POST['CONDUCTOR'])  ? trim($_POST['CONDUCTOR'])  : null;
    $AUXILIAR1  = isset($_POST['AUXILIAR1'])  ? trim($_POST['AUXILIAR1'])  : null;
    $AUXILIAR2  = isset($_POST['AUXILIAR2'])  ? trim($_POST['AUXILIAR2'])  : null;
    $AUXILIAR3  = isset($_POST['AUXILIAR3'])  ? trim($_POST['AUXILIAR3'])  : null;

    $OPERADORES = [];
    if (!empty($CONDUCTOR))  $OPERADORES['CONDUCTOR']  = $CONDUCTOR;
    if (!empty($AUXILIAR1))  $OPERADORES['AUXILIAR1']  = $AUXILIAR1;
    if (!empty($AUXILIAR2))  $OPERADORES['AUXILIAR2']  = $AUXILIAR2;
    if (!empty($AUXILIAR3))  $OPERADORES['AUXILIAR3']  = $AUXILIAR3;

    // Registrar o actualizar tabla de operadores
    foreach ($OPERADORES as $tipo_op => $nombre) {
        $nombre_esc = mysqli_real_escape_string($conexion, $nombre);

        $queryC = "SELECT Id_SERG FROM rd_operadores 
                   WHERE Id_SERG = '$ID' AND TIPO_OP = '$tipo_op'";
        $resultC = mysqli_query($conexion, $queryC);

        if (mysqli_num_rows($resultC) == 0) {
            // Insertar nuevo operador
            $queryN = "INSERT INTO rd_operadores (Id_SERG, TIPO_OP, NOMBRE) 
                       VALUES ('$ID', '$tipo_op', '$nombre_esc')";
            mysqli_query($conexion, $queryN);
        } else {
            // Actualizar nombre de operador existente
            $queryA = "UPDATE rd_operadores 
                       SET NOMBRE = '$nombre_esc' 
                       WHERE TIPO_OP = '$tipo_op' AND Id_SERG = '$ID'";
            mysqli_query($conexion, $queryA);
        }

        // Marcar usuario como no disponible
        $queryDIS = "UPDATE usuarios 
                     SET user_disponible = 'no' 
                     WHERE user_nombre = '$nombre_esc'";
        mysqli_query($conexion, $queryDIS);
    }

    mysqli_close($conexion);

    echo '<script type="text/javascript">
            window.location.href="./../rd_programaciones_read.php?f=' . $FECHA . '";
          </script>';
    exit();
}
?>
