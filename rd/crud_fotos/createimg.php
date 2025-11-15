

<?php include("../../data/conexion.php"); ?>
<?php
if ($_FILES['head_imagen']['name'] != null) {

    $name_img = $_FILES['head_imagen']['name']; // obtiene el nombre
    $archivo = $_FILES['head_imagen']['tmp_name'];  // obtiene el archivo
    $destino = "../../img/rutas";
    $destino = $destino . "/" . $name_img; // imagen/nombre.jpg
    $IMG = "img/rutas";
    $IMG = $IMG . "/" . $name_img; // imagen/nombre.jpg
    move_uploaded_file($archivo, $destino);
    $idr = $_POST['idr'];
    $idp = $_POST['idp'];
    $idd = $_POST['idd'];
    $TIPO = $_POST['tipo']; 
    $Id_SERG = $idp;
    $ID_SERV = $idr;
    $ID_DESG = $idd;
    $ALCANCE = $_POST['ALCANCE'];
    $Redirigir = $_POST['Redirigir'];
    $foto = $_POST['foto']?? '';


    $query = "INSERT INTO rd_fotos (
        TIPO,
        IMG,
        ALCANCE,
        Id_SERG,
        ID_SERV,
        ID_DESG
    ) VALUES (
        '$TIPO',
        '$IMG',
        '$ALCANCE',
        '$Id_SERG',
        '$ID_SERV',
        '$ID_DESG'
    )";

    // Ejecutar la consulta
    $result = mysqli_query($conexion, $query);
    $query = "UPDATE rd_inicio_fin set FOTO_INICIO = 'SI' WHERE Id_SERG ='$idp'"; mysqli_query($conexion, $query);

    // Redirigir después de la inserción

switch ($Redirigir) {
              
              case 'panel_user':
                   echo '<meta http-equiv="refresh" content="0;url=./../wt_panel_user.php?idp=' . $idp . '" />';
                   $query = "UPDATE rd_inicio_fin set FOTO_INICIO = 'SI' WHERE Id_SERG ='$idp'"; mysqli_query($conexion, $query);
                  break;
              
              case 'panel_fin':
                   echo '<meta http-equiv="refresh" content="0;url=./../wt_panel_user.php?idp=' . $idp . '" />';
                   $query = "UPDATE rd_inicio_fin set FOTO_FIN = 'SI' WHERE Id_SERG ='$idp'"; mysqli_query($conexion, $query);
                  break;


              case 'ruta_ruta':

                  echo '<meta http-equiv="refresh" content="0;url=./../wt_ruta_ruta.php?idp=' . $idp . '&idr=' . $idr . '" />';
                  
                  $query = "UPDATE hruta set hr_foto = $foto  WHERE id_serv ='$idr'"; mysqli_query($conexion, $query);
                  break;

               case 'ruta_descargas':
                  echo '<meta http-equiv="refresh" content="0;url=./../wt_ruta_descargas.php?idp=' . $idp . '&idr=' . $idr . '&idd=' . $idd . '" />';
                   $query = "UPDATE  rd_descargas set desg_foto = 'SI' WHERE id_descaga ='$idd'"; mysqli_query($conexion, $query);                 
                  break; 

              case 'wt_images':

                   echo '<meta http-equiv="refresh" content="0;url=./../wt_images.php?idp=' . $idp . '&idr=' . $idr .'" />';
                  break;

              case 'ruta_desimg':
                  echo '<meta http-equiv="refresh" content="0;url=./../wt_ruta_desimg.php?idp=' . $idp . '&idr=' . $idr . '&idd=' . $idd . '" />';
                  break;


          } 
}


?>
