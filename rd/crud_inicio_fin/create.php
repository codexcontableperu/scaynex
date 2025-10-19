<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ASISTENCIA---*/

if (isset($_POST['guardar'])) {

$tabla = 'rd_inicio_fin';
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

$columns1 = array(
'*ID_IF*',
'*ID_CTRL*',
'*HORA_SALIDA_BASE*',
'*KM_SALIDA_BASE*',
'*HORA_INGRESO_ALM*',
'*KM_LLEGADA_ALM*',
'*HORA_SALIDA_ALM*',

);
    // Crear el reporte con saltos de línea excluyendo los valores nulos
    $reporte = "";
    for ($i = 0; $i < count($columns1); $i++) {
        // Agregar la condición para excluir los valores nulos
        if ($values[$i] !== "NULL" && $values[$i] !== "''") {
            $reporte .= $columns1[$i] . ' : ' . $values[$i] . "%0A";
        }
    }


/*---NEW MENSAJE ---*/

$titulo = "
*REPORTE DE SALIDA*:%0A

";

$mensaje = $titulo . $reporte ;

//echo $mensaje;
//die();
    /*---redireccion ---*/
 ?>   
<meta http-equiv="refresh" 
      content="0;url=https://wa.me/?text=<?php echo $mensaje ?>" />
<?php 

exit();
}

?>