<?php include("./../../data/conexion.php"); ?>

<?php 

if (isset($_POST['guardar'])) {
    $PLACA = $_POST["PLACA"];
    $S_FECHA = $_POST["S_FECHA"];

    // Convertir la fecha al formato 'YYYY-MM-DD'
    $S_FECHA = date('Y-m-d', strtotime($S_FECHA));

    // Consulta para verificar si ya existe la placa para la fecha dada
    $query = "
    SELECT rd_segimientos_head.Id_SERG, rd_segimientos_head.S_FECHA, rd_segimientos_head.PLACA
    FROM rd_segimientos_head
    WHERE rd_segimientos_head.S_FECHA = '$S_FECHA' AND rd_segimientos_head.PLACA = '$PLACA'
    ";

    $result = mysqli_query($conexion, $query);
    $numfilas = mysqli_num_rows($result);

    if ($numfilas > 0) {
        echo "La placa ya está registrada para esta fecha.";
        echo '<br><a href="./../programacion.php?f=' . $S_FECHA . '">Volver</a>';
    } else {
        // Si no existe, proceder con la inserción
        $EPS = $_POST["EPS"];
        $TEMPERATURA = $_POST["TEMPERATURA"];
        $CONDUCTOR = $_POST["CONDUCTOR"];
        $AUXILIAR1 = $_POST["AUXILIAR1"];
        $AUXILIAR2 = $_POST["AUXILIAR2"];
        $AUXILIAR3 = $_POST["AUXILIAR3"];
        $SUPERVISOR = $_POST["SUPERVISOR"];
        $RESGUARDO = $_POST["RESGUARDO"];
        $TIPO_DESPACHO = $_POST["TIPO_DESPACHO"];
        $SERVICIOS = $_POST["SERVICIOS"];
        $ID_CLIENTE = $_POST["ID_CLIENTE"];
        $CUENTA = $_POST["CUENTA"];
        $EMPRESA = $_POST["EMPRESA"];
        $H_CITA = $_POST["H_CITA"];
        $H_CITA_R = $_POST["H_CITA_R"];
        $OBS_PROG = $_POST["OBS_PROG"];
        $S_USER = $_POST["id_user"];

        $query = "INSERT INTO rd_segimientos_head(  
            S_FECHA,
            EPS,
            TEMPERATURA,
            PLACA,
            CONDUCTOR,
            AUXILIAR1,
            AUXILIAR2,
            AUXILIAR3,
            SUPERVISOR,
            RESGUARDO,
            TIPO_DESPACHO,
            SERVICIOS,
            ID_CLIENTE,
            CUENTA,
            EMPRESA,
            H_CITA,
            H_CITA_R,
            OBS_PROG,
            S_USER
        ) VALUES (
            '$S_FECHA',
            '$EPS',
            '$TEMPERATURA',
            '$PLACA',
            '$CONDUCTOR',
            '$AUXILIAR1',
            '$AUXILIAR2',
            '$AUXILIAR3',
            '$SUPERVISOR',
            '$RESGUARDO',
            '$TIPO_DESPACHO',
            '$SERVICIOS',
            '$ID_CLIENTE',
            '$CUENTA',
            '$EMPRESA',
            '$H_CITA',
            '$H_CITA_R',
            '$OBS_PROG',
            '$S_USER'
        )";

        $result = mysqli_query($conexion, $query);

        if ($result) {
            echo '<script type="text/javascript">
                window.location.href="./../programacion.php?f=' . $S_FECHA . '";
            </script>';
        } else {
            echo "Error al insertar el registro: " . mysqli_error($conexion);
        }

        mysqli_close($conexion);
        
    }
}
?>
