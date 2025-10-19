<?php include('../includes/header.php'); ?>
<?php include("./../../data/conexion.php"); ?>


<?php 

$idp=$_POST['idp'];
$idr=$_POST['idr'];
$i=$_POST['i'];
$txt=$_POST['txt'];


switch ($i) {
    case 1:

          $query = "UPDATE hruta set h_inicio = '$txt' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);

        break;
    case 12:
        
          $query = "UPDATE hruta set t_inicio = '$txt'  WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);

        break;
    case 2:
   
          $query = "UPDATE hruta set h_salidabase = '$txt' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);

        break;

    case 22:
    
          $query = "UPDATE hruta set t_salidabase = '$txt' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);

        break;

    case 20:
          $query = "UPDATE hruta set k_salidabase = '$txt' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;

    case 3:
          $query = "UPDATE hruta set h_llegadaorigen = '$txt' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);
        break;
    case 33:
          $query = "UPDATE hruta set t_llegadaorigen = '$txt' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 30:
          $query = "UPDATE hruta set k_llegadaorigen = '$txt' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;

    case 4:
          $query = "UPDATE hruta set h_iniciocarga  = '$txt' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 44:
          $query = "UPDATE hruta set t_iniciocarga = '$txt' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 5:
          $query = "UPDATE hruta set h_salidaorigen = '$txt' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;

    case 55:
          $query = "UPDATE hruta set t_salidaorigen  = '$txt' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 6:
          $query = "UPDATE hruta set h_llegadadestino = '$txt' WHERE id_ruta ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 66:
          $query = "UPDATE hruta set t_llegadadestino  = '$txt' WHERE id_ruta ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 60:
          $query = "UPDATE hruta set k_llegadadestino  = '$txt' WHERE id_ruta ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 7:
          $query = "UPDATE hruta set h_iniciodescarga = '$txt' WHERE id_ruta ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 77:
          $query = "UPDATE hruta set t_iniciodescarga = '$txt' WHERE id_ruta ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 8:
          $query = "UPDATE hruta set h_retorno = '$txt' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;

    case 88: 
          $query = "UPDATE hruta set t_retorno = '$txt' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 80:
          $query = "UPDATE hruta set k_retorno = '$txt' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 90:
          $query = "UPDATE hruta set ruta_obs = '$txt' WHERE id_ruta ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;        

}

 ?>


 <meta http-equiv="refresh" content="0;url=./../ruta_create_read.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>" />
