<?php include("./../../data/conexion.php"); ?>


<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
     $Redirigir = $_GET['R'];

// Consulta para obtener datos de la tabla rd_fotos
$query = "SELECT * FROM rd_fotos WHERE ID_FOTO='$id'";
$result = mysqli_query($conexion, $query);
$filas = mysqli_fetch_assoc($result);
$idp = $filas['Id_SERG'];	
$idr = $filas['ID_SERV'];
$idd = $filas['ID_DESG'];


/*---query elimina---*/
$query= "DELETE FROM rd_fotos WHERE ID_FOTO = $id";
/*---ejecuta ---*/
$result = mysqli_query($conexion, $query);

    // Redirigir después de la inserción

switch ($Redirigir) {
              case 'panel_user':
                   echo '<meta http-equiv="refresh" content="0;url=./../wt_panel_user.php?idp=' . $idp . '" />';
                  break;
              
              case '4':
                   echo '<meta http-equiv="refresh" content="0;url=./../wt_images.php?idp=' . $idp . '&idr=' . $idr .'" />';
                  break;

              case '5':
                  echo '<meta http-equiv="refresh" content="0;url=./../wt_ruta_desimg.php?idp=' . $idp . '&idr=' . $idr . '&idd=' . $idd . '" />';
                  break;            

          } 
}

