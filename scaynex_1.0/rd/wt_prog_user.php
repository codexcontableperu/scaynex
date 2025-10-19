<?php session_start(); 


if (isset($_SESSION['usuario'])) {
      $userup=$_SESSION['usuario'];
      $id_userup=$_SESSION['id_usuario'];
      $dni_user=$_SESSION['user_dni'];
} else {
  session_destroy();
  mysqli_close($conexion);
  echo'<script type="text/javascript">
    window.location.href="./index.php";
    </script>';

}
?>
<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="whatsaap/stilo_what.css">


    <div id="header">
        <div id="whatsapp-text">
            <span class="icon-user"></span>  <?php  echo $userup ; ?> 

        </div>

        <div id="header-icons">
            <img src="whatsaap/camera-icon.png" alt="Cámara" id="camera-icon">
            <img src="whatsaap/search-icon.png" alt="Buscar" id="search-icon">
            <img src="whatsaap/menu-icon.png" alt="Menú" id="menu-icon">
        </div>
    </div>

    <div id="second-header">
        <img src="whatsaap/user-icon.png" alt="Usuario" id="user-icon">
        <a class="boton bton selec" href="wt_prog_user.php?dni=<?php  echo $dni_user ; ?> ">Ordenes</a>
        &nbsp &nbsp 

    </div>



<?php
// Verificar la conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

$sql = "SELECT Id_SERG, CONDUCTOR, ID_CLIENTE, S_FECHA, PLACA, AUXILIAR1, AUXILIAR2, AUXILIAR3, PENDIENTE 
        FROM rd_segimientos_head 
        WHERE PENDIENTE = 1";

$result = mysqli_query($conexion, $sql);

$nueva_tabla = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Añadir filas para cada operador
        $nueva_tabla[] = array("TIPO_OPERADOR" => "CONDUCTOR", "NOMBRE" => $row["CONDUCTOR"], "Id_SERG" => $row["Id_SERG"], "PENDIENTE" => $row["PENDIENTE"], "ID_CLIENTE" => $row["ID_CLIENTE"], "S_FECHA" => $row["S_FECHA"], "PLACA" => $row["PLACA"]);
        $nueva_tabla[] = array("TIPO_OPERADOR" => "AUXILIAR1", "NOMBRE" => $row["AUXILIAR1"], "Id_SERG" => $row["Id_SERG"], "PENDIENTE" => $row["PENDIENTE"], "ID_CLIENTE" => $row["ID_CLIENTE"], "S_FECHA" => $row["S_FECHA"], "PLACA" => $row["PLACA"]);
        $nueva_tabla[] = array("TIPO_OPERADOR" => "AUXILIAR2", "NOMBRE" => $row["AUXILIAR2"], "Id_SERG" => $row["Id_SERG"], "PENDIENTE" => $row["PENDIENTE"], "ID_CLIENTE" => $row["ID_CLIENTE"], "S_FECHA" => $row["S_FECHA"], "PLACA" => $row["PLACA"]);
        $nueva_tabla[] = array("TIPO_OPERADOR" => "AUXILIAR3", "NOMBRE" => $row["AUXILIAR3"], "Id_SERG" => $row["Id_SERG"], "PENDIENTE" => $row["PENDIENTE"], "ID_CLIENTE" => $row["ID_CLIENTE"], "S_FECHA" => $row["S_FECHA"], "PLACA" => $row["PLACA"]);
    }
} else {
    echo "0 resultados";
}



// Filtrar la nueva tabla por el nombre específico
// $nombre_buscado = "CORDOVA MONTES JORGE MAXIMO ";
$query = "SELECT usuarios.id_user, usuarios.user_nombre FROM usuarios WHERE usuarios.id_user = $id_userup";

// Ejecutar la consulta (asumiendo uso de mysqli)
$result = mysqli_query($conexion, $query);

// Verificar si hay resultados
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result); // Obtener una fila como array asociativo
    $nombre_buscado = $row['user_nombre']; // Extraer el nombre
} else {
    $nombre_buscado = "No encontrado";
}



$resultado = array_filter($nueva_tabla, function($fila) use ($nombre_buscado) {
    return $fila["NOMBRE"] === $nombre_buscado;
});

// Imprimir el resultado filtrado
//foreach ($resultado as $fila) {
//    echo "TIPO DE OPERADOR: {$fila['TIPO DE OPERADOR']} - NOMBRE: {$fila['NOMBRE']} - Id_SERG: {$fila['Id_SERG']} - PENDIENTE: {$fila['PENDIENTE']} - ID_CLIENTE: {$fila['ID_CLIENTE']} - S_FECHA: {$fila['S_FECHA']} - PLACA: {$fila['PLACA']}<br>";
//}


?>




<br>
<style>
.titu {

  align-items: center;
  text-align: center;
}




</style>

<div class="titu" >
  <h5>Programaciones Activas</h5>

</div>

<br>


<div class="botones">
  <div class="container text-center">
    <div class="row d-flex justify-content-center"> <!-- d-flex y justify-content-center para alinear en línea -->
      <?php foreach ($resultado as $filaso) { ?>
        <a class="btn btn-lg btn-dark square-btn mx-2" style="color: white;" href="wt_panel_user.php?idp=<?php echo $filaso['Id_SERG']?>">
          <span class="icon-truck"></span><br>
          <span style="font-size: 13px;"><?php echo $filaso['TIPO_OPERADOR']?></span><br>
          <?php echo $filaso['PLACA']?><br>
          <span style="font-size: 13px;"><?php echo $filaso['ID_CLIENTE']?></span><br>
          <span style="font-size: 13px;"><?php echo $filaso['S_FECHA']?></span>
          
        </a>
      <?php } ?>
    </div>
  </div>
</div>


<!-- menu reportes-->
 <?php include('wt_menureportes.php'); ?>

 
<?php include('includes/footer.php'); ?>