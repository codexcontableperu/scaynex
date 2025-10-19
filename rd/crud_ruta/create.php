<?php include("./../../data/conexion.php"); ?>

<?php 

/*---NEW ARTICULOS---*/

if (isset($_POST['guardar'])) {


  $user = $_POST['id_user'];
  $ID_SERG = $_POST['Id_SERG'];
  $HBASE = $_POST['H_BASE'];
  $glosa = 'OTR ' . $ID_SERG . "- " . $HBASE;


$query= "INSERT INTO hruta(  
ruta_glosa, 
id_user, 
id_prog 
) VALUES (
'$glosa',
'$user',
'$ID_SERG'
)";

/*---create ---*/
$result = mysqli_query($conexion, $query);

}

?>


<meta http-equiv="refresh" 
      content="0;url=./../wt_panel_user.php?id=<?php echo $ID_SERG ?>" />