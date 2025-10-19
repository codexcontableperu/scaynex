<?php include("./../../data/conexion.php"); ?>
<?php include('./../includes/session.php'); ?>

<?php


if (isset($_POST['user_nombre'])) {

  $c2 = $_POST['user_dni']; 


  if ($_FILES['user_avatar']['name']!= null) {

      $name_img=$_FILES['user_avatar']['name']; // obtiene el nombre
      $archivo=$_FILES['user_avatar']['tmp_name'];  // obtiene el archivo
      $destino="./../../panel/img/user";
      $destino=$destino."/".$name_img ; ///imagen/nombre.jpg
      $c3="img/user";
      $c3=$c3."/".$name_img ; ///imagen/nombre.jpg
      move_uploaded_file($archivo,$destino);
  
  }else{

     $c3= $_POST['avataractual'];

  }


  $c4 = $_POST['user_nombre'];
  $c6 = $_POST['user_nick'];
  $c8 = $_POST['user_telefono'];
  $c9 = $_POST['user_mail'];
  $c11 = $_POST['user_cargo'];
  $c12 = $_POST['user_clave'];


  $query = "UPDATE usuarios set

user_dni ='$c2',
user_avatar ='$c3',
user_nombre ='$c4',
user_nick ='$c6',
user_telefono  ='$c8',
user_mail  ='$c9',
user_cargo ='$c11',
user_clave ='$c12'

  WHERE id_user=$id_userup";

  mysqli_query($conexion, $query);

}


mysqli_close($conexion);
echo'<script type="text/javascript">
    window.location.href="./../home.php";
    </script>';
exit();

?>