<?php include("./../../data/conexion.php"); ?>

<?php 

if (isset($_GET['f'])) {

    $S_FECHA = mysqli_real_escape_string($conexion, $_GET["f"]);
    
    /*---query elimina---*/
    $query = "DELETE FROM rd_segimientos_head WHERE S_FECHA = '$S_FECHA'";
    /*---ejecuta ---*/
    $result = mysqli_query($conexion, $query);

    if (!$result) {
        die('Invalid query: ' . mysqli_error($conexion));
    }

    mysqli_close($conexion);
    echo '<script type="text/javascript">
        window.location.href="./../programacion.php?f=' . $S_FECHA . '";
    </script>';

    exit();
}

?>
