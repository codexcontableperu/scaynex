<?php 
try {
    // Inicializar $datetime con 'now' como valor predeterminado
    $datetime = 'now';

    // Si existe un valor específico que debe asignarse a $datetime, asegúrate de que sea una cadena válida
    // Aquí puedes agregar la lógica necesaria para asignar un valor diferente a $datetime si es necesario

    $date = new DateTime($datetime);
    $timestamp = new DateTime($datetime, new DateTimeZone('America/Lima'));
    
    // Formatear las fechas y horas según lo requerido
    $hoy = $timestamp->format('Y-m-d'); // Se cambió 'y-m-d' por 'Y-m-d' para año completo
    $horaa = $timestamp->format('H:i:s');
    $hoyfor = $timestamp->format('d-m-Y'); // Se cambió 'd-m-y' por 'd-m-Y' para año completo
    $fehra = $timestamp->format('d-m-Y H:i:s'); // Se cambió 'd-m-y-H:i:s' por 'd-m-Y H:i:s' para formato adecuado
    
    // Imprimir o utilizar las variables formateadas
    // echo "Hoy: $hoy\n";
    // echo "Hora: $horaa\n";
    // echo "Hoy formateado: $hoyfor\n";
    //echo "Fecha y hora: $fehra\n";
} catch (Exception $e) {
    // Manejar cualquier excepción que pueda ocurrir
    echo 'Error al crear la fecha: ' . $e->getMessage();
}
?>
