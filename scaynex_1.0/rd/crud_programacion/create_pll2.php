<?php include("./../../data/conexion.php"); ?>

<?php

/*---NEW programacion---*/

if (isset($_POST['guardar'])) {
    $S_FECHA = $_POST["S_FECHA"];
    $PLACA = $_POST["PLACA"];
    $S_USER = $_POST["id_user"];

    // Fetch data from the table rd_segimientos_pll
    $query = "SELECT * FROM rd_segimientos_pll";
    $result = mysqli_query($conexion, $query);

    // Initialize an empty array to store values
    $data = array();

    while ($filas = mysqli_fetch_assoc($result)) {
        // Extract data from the result set and push it into the array
        $data[] = $filas;
    }

    // Insert data into the table rd_segimientos_head using array_walk
    array_walk($data, function ($row) use ($conexion, $S_FECHA, $S_USER) {
        $query = "INSERT INTO rd_segimientos_head (
            S_FECHA,
            PLACA,
            S_USER,
            CONDUCTOR,
            AUXILIAR1,
            AUXILIAR2,
            AUXILIAR3,
            ID_CLIENTE,
            SERIVCIOS,
            H_CITA
        ) VALUES (
            '$S_FECHA',
            '{$row['PLACA']}',
            '$S_USER',
            '{$row['CONDUCTOR']}',
            '{$row['AUXILIAR1']}',
            '{$row['AUXILIAR2']}',
            '{$row['AUXILIAR3']}',
            '{$row['ID_CLIENTE']}',
            '{$row['SERIVCIOS']}',
            '{$row['H_CITA']}'
        )";

        mysqli_query($conexion, $query);
    });

    /*---redireccion ---*/
    mysqli_close($conexion);

    echo '<script type="text/javascript">
        window.location.href="./../programaciones_read.php?f=' . $S_FECHA . '";
    </script>';
}
?>
