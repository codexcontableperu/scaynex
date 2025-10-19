<?php include('../includes/header.php'); ?>
<?php include("./../../data/conexion.php"); ?>


<?php 

$idp=$_GET['idp'];
$idr=$_GET['idr'];
$i=$_GET['i'];



switch ($i) {
    case 1:

          $query = "UPDATE hruta set h_inicio = '$horaa' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);

        break;
    case 12:
        
          $query = "UPDATE hruta set t_inicio = '00.0'  WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);

        break;
    case 2:
   
          $query = "UPDATE hruta set h_salidabase = '$horaa' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);

        break;

    case 22:
    
          $query = "UPDATE hruta set t_salidabase = '00.0' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);

        break;

    case 20:
          $query = "UPDATE hruta set k_salidabase = '00.0' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;

    case 3:
          $query = "UPDATE hruta set h_llegadaorigen = '$horaa' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);
        break;
    case 33:
          $query = "UPDATE hruta set t_llegadaorigen = '00.0' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 30:
          $query = "UPDATE hruta set k_llegadaorigen = '00.0' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;

    case 4:
          $query = "UPDATE hruta set h_iniciocarga  = '$horaa' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 44:
          $query = "UPDATE hruta set t_iniciocarga = '00.0' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 5:
          $query = "UPDATE hruta set h_salidaorigen = '$horaa' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;

    case 55:
          $query = "UPDATE hruta set t_salidaorigen  = '00.0' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 6:
          $query = "UPDATE hruta set h_llegadadestino = '$horaa' WHERE id_ruta ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 66:
          $query = "UPDATE hruta set t_llegadadestino  = '00.00' WHERE id_ruta ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 60:
          $query = "UPDATE hruta set k_llegadadestino  = '00.00' WHERE id_ruta ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 7:
          $query = "UPDATE hruta set h_iniciodescarga = '$horaa' WHERE id_ruta ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 77:
          $query = "UPDATE hruta set t_iniciodescarga = '00.0' WHERE id_ruta ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 8:
          $query = "UPDATE hruta set h_retorno = '$horaa' WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;

    case 88:
          $query = "UPDATE hruta set t_retorno = '00.0'WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 80:
          $query = "UPDATE hruta set k_retorno = '00.0'WHERE id_prog ='$idp'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
        

}

 ?>


 <meta http-equiv="refresh" content="0;url=./../ruta_create_read.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>" />
