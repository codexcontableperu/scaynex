<?php
include("../../data/conexion.php");

if (isset($_POST['guardar'])) {
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


$columns1 = array(
'ID_SERV ',
'*REPORTE*',
'*EPS*',
'*TIPO_UNIDA*',
'*TIPO*',
'*PLACA*',
'*CONDUCTOR*',
'*AUXILIAR1*',
'*AUXILIAR2*',
'*AUXILIAR3*',
'*CUENTA*',
'*EMPRESA*',
'*CLIENTE*',
'*CITA*',

'*NBULTOS*',
'*PALETAS*',
'*DATALOGGER*',

'*TEMPERATURA*',
'*OBSERVACION*'
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
*REPORTE DIARIO*:%0A

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

