<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ASISTENCIA---*/

if (isset($_POST['guardar'])) {
# ACTUALIZAR UNA TABLA EN MYSQL USANDO PHP

$ID = $_POST['id'];
$tabla = 'rd_inicio_fin';

// Obtener la estructura de la tabla
$query = "DESCRIBE $tabla";
$result = mysqli_query($conexion, $query);

    $columns = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $columns[] = $row["Field"];
    }

// Obtener el nombre de la columna de índice primario
$indice = '';
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['Key'] == 'PRI') {
        $indice = $row['Field'];
        break;  // Tomamos la primera columna de la clave primaria
    }
}

// Construir la parte SET de la consulta UPDATE
$set_values = '';
$columnsUP = array();

// Restablecer el puntero del resultado
mysqli_data_seek($result, 0);

while ($row = mysqli_fetch_assoc($result)) {
    $campo = $row['Field'];
    if ($campo !== $indice) {
        $valor = isset($_POST[$campo]) ? mysqli_real_escape_string($conexion, $_POST[$campo]) : NULL;
        $set_values .= "$campo = '$valor', ";
        $columnsUP[] = $campo;  // Agregar la columna al array
    }
}
$set_values = rtrim($set_values, ', ');

// Crear la consulta para actualizar la tabla
$query = "UPDATE $tabla SET $set_values WHERE $indice = '$ID'";

// Actualizar la tabla
mysqli_query($conexion, $query);




    // Obtener los valores de los campos del formulario
    $values = array();
    foreach ($columns as $campo) {
        if (isset($_POST[$campo])) {
            $values[] = "'" . mysqli_real_escape_string($conexion, $_POST[$campo]) . "'";
        } else {
            $values[] = "NULL";
        }
    }


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