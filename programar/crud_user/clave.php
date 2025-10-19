<?php include("./../../data/conexion.php"); ?>
<?php include('./../includes/session.php'); ?>

<?php


if (isset($_GET['id'])) {
$id = $_GET['id'];
$clave = $_GET['a']; 

if ($clave!=123) {
  $nuevaclave  = 123;
} else {
  $nuevaclave  = 123;
}



  $query = "UPDATE usuarios set

user_clave =$nuevaclave 

  WHERE id_user=$id";

  mysqli_query($conexion, $query);

}


mysqli_close($conexion);
echo'<script type="text/javascript">
    window.location.href="./../user_listado.php";
    </script>';
exit();

?>