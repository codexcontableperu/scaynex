<?php include("./../../data/conexion.php"); ?>
<?php
if (!$conexion) {
    die('Error de conexión: ' . mysqli_connect_error());
}
// Validar que los datos vienen del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tipo_dh'])) {
    // Capturamos los datos
    $tipo_dh = $_POST['tipo_dh']; // D = Debe (Egreso), H = Haber (Ingreso)
    $id_concepto = $_POST['id_concepto'];
    $importe = $_POST['importe'];
    $observacion = mysqli_real_escape_string($conexion, $_POST['observacion']);
    $id_user = $_POST['id_user']; // Aquí deberías capturar el ID del usuario logueado
    $dni_user = $_POST['dni_user']; // Aquí deberías capturar el DNI del usuario logueado
    $id_programacion = $_POST['id_programacion']; // Debes capturar el ID de programación activa
    
    // Calculamos el saldo (positivo o negativo)
    $saldo = ($tipo_dh == 'H') ? -$importe : $importe;

    // Preparar la imagen
    $ruta_destino = '';
    if (isset($_FILES['doc_imagen']) && $_FILES['doc_imagen']['error'] == 0) {
        $directorio = 'fotos_gastos/'; // Carpeta física desde donde está este archivo
        $nombre_archivo = uniqid() . '_' . basename($_FILES['doc_imagen']['name']);
        // Ruta física real en el servidor
        $ruta_fisica = __DIR__ . '/' . $directorio . $nombre_archivo;
        // Ruta web que se guardará en la base de datos
        $ruta_destino = 'crud_gastos/' . $directorio . $nombre_archivo;
        // Mover la imagen al directorio físico
        if (!move_uploaded_file($_FILES['doc_imagen']['tmp_name'], $ruta_fisica)) {
            echo "Error al subir la imagen.";
            exit;
        }
    }
    
    // Insertamos el registro
    $query = "INSERT INTO rd_control_cuentas 
        (id_programacion, id_user, id_concepto, importe, tipo_dh, saldo, observacion, estado, nro_comprobante, doc_imagen)
        VALUES 
        ($id_programacion, $id_user, $id_concepto, $importe, '$tipo_dh', $saldo, '$observacion', 0, '', '$ruta_destino')";
    
    if (mysqli_query($conexion, $query)) {
        // Redireccionamos al panel del usuario con id de programación
        
        if (!empty($id_programacion)) { // ← AQUÍ FALTABA EL PARÉNTESIS DE CIERRE
            // Si $id_programacion existe y es diferente de 0 o null
            echo '<script type="text/javascript">
                window.location.href="./../wt_panel_user.php?idp=' . $id_programacion . '";
            </script>';
            exit;
        } else {
            // Caso contrario
            echo '<script type="text/javascript">
                window.location.href="./../wt_prog_user.php?dni=' . $dni_user . '";
            </script>';
            exit;
        }
    } else {
        echo "Error al guardar la operación: " . mysqli_error($conexion);
    }
} else {
    echo "Datos no válidos o acceso indebido.";
}
mysqli_close($conexion);
?>
