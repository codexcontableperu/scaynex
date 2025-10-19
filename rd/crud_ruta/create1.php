<?php include("./../../data/conexion.php"); ?>
<?php 
    $ids= $_GET['ids'];
    $idp= $_GET['idp'];

   // consulta  de id ruta
$queryR="
SELECT hruta.id_ruta, hruta.id_serv
FROM hruta
WHERE (((hruta.id_serv)=$ids))";
$resultR=mysqli_query($conexion, $queryR);
$numfilas = mysqli_num_rows($resultR);

echo $numfilas ;

 
if ($numfilas >0) {

        echo '<script type="text/javascript">
            window.location.href="./../wt_ruta_ruta.php?idp=' . $idp. '&idr=' . $ids. '";
        </script>';

} else {


    // Crear registro en hoja de ruta

  $id_user = 1;
  $glosa = 'OTR ' . $idp  . "- " . $ids;

$query= "INSERT INTO hruta(  
ruta_glosa, 
id_user, 
id_prog, 
id_serv
) VALUES (
'$glosa',
'$id_user',
'$idp',
'$ids'
)";   


    // Ejecutar la consulta
   $result = mysqli_query($conexion, $query);

$queryR="
SELECT hruta.id_ruta, hruta.id_prog
FROM hruta
WHERE (((hruta.id_prog)=$idp))";
$resultR=mysqli_query($conexion, $queryR);
$filasR=mysqli_fetch_assoc($resultR);
$id_ruta= $filasR ['id_ruta'];

      mysqli_close($conexion);



        echo '<script type="text/javascript">
            window.location.href="./../wt_ruta_ruta.php?idp=' . $idp. '&idr=' . $ids. '";
        </script>';


}

?>