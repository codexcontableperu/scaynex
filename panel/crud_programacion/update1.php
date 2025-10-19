<?php include("../../data/conexion.php"); 


if (isset($_POST['Id_SERG'])) {
    $FECHA= $_POST['FECHA'];
    $ID= $_POST['Id_SERG'];
    $tabla =  'rd_segimientos_head';

    // Obtener la estructura de la tabla
    $query = "DESCRIBE $tabla";
    $result = mysqli_query($conexion, $query);

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
    $columns = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $campo = $row['Field'];
        if ($campo !== $indice) {
            $valor = isset($_POST[$campo]) ? mysqli_real_escape_string($conexion, $_POST[$campo]) : NULL;
            $set_values .= "$campo = '$valor', ";
        }
    }
    $set_values = rtrim($set_values, ', ');

    // Crear la consulta para actualizar la tabla
    $query = "UPDATE $tabla SET $set_values WHERE $indice = '$ID'";

    // Actualizar la tabla
    mysqli_query($conexion, $query);

    // REGUISTRAR O ACTUALIZAR TABLA DE OPERADORES
    // verificas cada post si esta vacio antes de agregarlo al array
$CONDUCTOR = isset($_POST['CONDUCTOR']) ? $_POST['CONDUCTOR'] : null;
$AUXILIAR1 = isset($_POST['AUXILIAR1']) ? $_POST['AUXILIAR1'] : null;
$AUXILIAR2 = isset($_POST['AUXILIAR2']) ? $_POST['AUXILIAR2'] : null;
$AUXILIAR3 = isset($_POST['AUXILIAR3']) ? $_POST['AUXILIAR3'] : null;

// Construir el array $OPERADORES solo con valores no vacíos o nulos

$OPERADORES = array();
if ($CONDUCTOR !== null && $CONDUCTOR !== '') {
    $OPERADORES[] = "CONDUCTOR";
}
if ($AUXILIAR1 !== null && $AUXILIAR1 !== '' ) {
    $OPERADORES[] = "AUXILIAR1";
}
if ($AUXILIAR2 !== null && $AUXILIAR2 !== '') {
    $OPERADORES[] = "AUXILIAR2";
}
if ($AUXILIAR3 !== null && $AUXILIAR3 !== '') {
    $OPERADORES[] = "AUXILIAR3";
}


   // REGUISTRAR O ACTUALIZAR TABLA DE OPERADORES

foreach ($OPERADORES as $OPERADOR) {

$queryC="
SELECT rd_operadores.Id_SERG, rd_operadores.TIPO_OP, rd_operadores.NOMBRE
FROM rd_operadores
WHERE (((rd_operadores.Id_SERG)='$ID') AND ((rd_operadores.TIPO_OP)='$OPERADOR'));
";
$resultC=mysqli_query($conexion, $queryC);
//$filasC=mysqli_fetch_assoc($resultC);
$numfilas = mysqli_num_rows($resultC);
//$TIPO_OP=$filasC ['TIPO_OP'];

if ($numfilas == 0) {
    
   
$queryN= "INSERT INTO  rd_operadores (Id_SERG, TIPO_OP,NOMBRE) 
          VALUES ('$ID','$OPERADOR','${$OPERADOR}')";
$resultN = mysqli_query($conexion, $queryN);   

$queryDIS = "UPDATE usuarios set user_disponible ='no'
           WHERE user_nombre ='${$OPERADOR}'";
mysqli_query($conexion, $queryDIS); 

} else {


$queryA = "UPDATE rd_operadores set NOMBRE ='${$OPERADOR}'
           WHERE TIPO_OP ='$OPERADOR' AND Id_SERG ='$ID'";
mysqli_query($conexion, $queryA);

$queryDIS = "UPDATE usuarios set user_disponible ='no'
           WHERE user_nombre ='${$OPERADOR}'";
mysqli_query($conexion, $queryDIS);


}

}





    mysqli_close($conexion);

        echo '<script type="text/javascript">
            window.location.href="./../rd_programaciones_read.php?f=' . $FECHA. '";
        </script>';

    exit();
}
?>
