<?php include("./../../data/conexion.php"); ?>
<?php include('./../includes/session.php'); ?>

<?php

if (isset($_GET['idp'])) {

  $idp = $_GET['idp']; 
  $idr = $_GET['idr']; 


     $query3="
SELECT programaciones.id_prog, programaciones.vh_asignado, programaciones.id_conductor, programaciones.id_ayudante, programaciones.id_estado, usuarios.user_ordenes AS otrconsuctor, usuarios_1.user_ordenes AS otrayudante, unidades.vh_ordenes
FROM ((programaciones INNER JOIN usuarios ON programaciones.id_conductor = usuarios.id_user) INNER JOIN usuarios AS usuarios_1 ON programaciones.id_ayudante = usuarios_1.id_user) INNER JOIN unidades ON programaciones.vh_asignado = unidades.id_vh
WHERE (((programaciones.id_prog)=$idp))

                ";
     $result3=mysqli_query($conexion, $query3);
     $filas3=mysqli_fetch_assoc($result3);

$unidad = $filas3 ['vh_asignado']; 
$conductor = $filas3 ['id_conductor']; 
$ayudante = $filas3 ['id_ayudante']; 
$estado = $filas3 ['id_estado'];

$otrunidad = $filas3 ['vh_ordenes']-1; 
$otrconductor = $filas3 ['otrconsuctor']-1; 
$otrayudante = $filas3 ['otrayudante']-1;


$query4 = "UPDATE unidades set vh_ordenes ='$otrunidad'
          WHERE id_vh=$unidad";
         mysqli_query($conexion, $query4);


$query = "UPDATE usuarios set user_ordenes ='$otrconductor'
          WHERE id_user=$conductor";
         mysqli_query($conexion, $query);

$query2 = "UPDATE usuarios set user_ordenes ='$otrayudante'
          WHERE id_user=$ayudante";
         mysqli_query($conexion, $query2);



$query5 = "UPDATE programaciones set id_estado =1
          WHERE id_prog=$idp";
         mysqli_query($conexion, $query5);

}


?>

 <meta http-equiv="refresh" content="0;url=./../ruta_create_read.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>" />