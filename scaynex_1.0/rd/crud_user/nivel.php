<?php include("./../../data/conexion.php"); ?>
<?php include('./../includes/session.php'); ?>

<?php


if (isset($_GET['id'])) {
$id = $_GET['id'];
$perfil = $_GET['a']; 

if ($perfil==1) {
  $nivel = 2;
} else if ($perfil==2) {
  $nivel = 3;
} else {
  $nivel = 1;
}


  $query = "UPDATE usuarios set

user_perfil = $nivel

  WHERE id_user=$id";

  mysqli_query($conexion, $query);

}


mysqli_close($conexion);
echo'<script type="text/javascript">
    window.location.href="./../user_listado.php";
    </script>';
exit();

?>