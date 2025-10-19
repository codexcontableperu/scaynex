<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ASISTENCIA---*/

if (isset($_POST['guardar'])) {
# ACTUALIZAR UNA TABLA EN MYSQL USANDO PHP
$Id_SERG = $_POST['Id_SERG'] ;    
$ID = $_POST['id'];
$KM_FINAL_SERV = $_POST['KM_FINAL_SERV'];
$HORA_LLEGADA_BASE = $_POST['HORA_LLEGADA_BASE'];
$KM_LLEGADA_BASE = $_POST['KM_LLEGADA_BASE'];

$tabla = 'rd_inicio_fin';


// Actualizar la tabla

  $query = "UPDATE $tabla set

KM_FINAL_SERV ='$KM_FINAL_SERV',
HORA_LLEGADA_BASE ='$HORA_LLEGADA_BASE',
KM_LLEGADA_BASE ='$KM_LLEGADA_BASE'

  WHERE ID_IF=$ID";
mysqli_query($conexion, $query);

// actualizar  - liberar operadores

$queryC="
SELECT rd_operadores.Id_SERG,  rd_operadores.NOMBRE
FROM rd_operadores
WHERE (((rd_operadores.Id_SERG)='$Id_SERG'));
";
$resultC=mysqli_query($conexion, $queryC);

while($filasC=mysqli_fetch_assoc($resultC)) {
$PERSONAL= $filasC ['NOMBRE'];
$queryDIS = "UPDATE usuarios set user_disponible ='si'
           WHERE user_nombre ='$PERSONAL'";
mysqli_query($conexion, $queryDIS); 

}

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


$columns1 = array(
'*ID_IF*',
'*ID_CTRL*',
'*KM_FINAL_SERV*',
'*HORA_LLEGADA_BASE*',
'*KM_LLEGADA_BASE*',

);


    // Crear el reporte con saltos de línea excluyendo los valores nulos
    $reporte = "";
    for ($i = 0; $i < count($columns); $i++) {
        // Agregar la condición para excluir los valores nulos
        if ($values[$i] !== "NULL" && $values[$i] !== "''") {
            $reporte .= $columns[$i] . ' : ' . $values[$i] . "%0A";
        }
    }


/*---NEW MENSAJE ---*/

$titulo = "
*REPORTE RETORNO*:%0A

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