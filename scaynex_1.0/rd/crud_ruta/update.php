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
          $query = "UPDATE hruta set h_llegadaorigen = '$horaa' WHERE id_serv ='$idr'";
          mysqli_query($conexion, $query);
          $query = "UPDATE rd_segimientos_head SET  ESTADO_IDP = 2 WHERE Id_SERG = $idp";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);
        break;
    case 33:
          $query = "UPDATE hruta set t_llegadaorigen = '00.0' WHERE id_serv ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 30:
          $query = "UPDATE hruta set k_llegadaorigen = '00.0' WHERE id_serv ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;

    case 4:
          $query = "UPDATE hruta set h_iniciocarga  = '$horaa' WHERE id_serv ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 44:
          $query = "UPDATE hruta set t_iniciocarga = '00.0' WHERE id_serv ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;
    case 5:
          $query = "UPDATE hruta set h_salidaorigen = '$horaa' WHERE id_serv ='$idr'";
          mysqli_query($conexion, $query);
          $query = "UPDATE rd_segimientos_head SET  ESTADO_IDP = 3 WHERE Id_SERG = $idp";
          mysqli_query($conexion, $query);          
          mysqli_close($conexion);        
          break;

    case 55:
          $query = "UPDATE hruta set t_salidaorigen  = '00.0' WHERE id_serv ='$idr'";
          mysqli_query($conexion, $query);
          mysqli_close($conexion);        
          break;


    case 9:
          $query = "UPDATE hruta set WT_ENVIO = 'SI' WHERE id_serv ='$idr'";
          mysqli_query($conexion, $query);
           ?>   
          <meta http-equiv="refresh" 
                content="0;url=../crud_mensajes/msj_almacen.php?idr=<?php echo $idr?> " />
          <?php 
          mysqli_close($conexion);  
          die();
          break;        

}

 ?>


 <meta http-equiv="refresh" content="0;url=./../wt_ruta_ruta.php?idp=<?php echo $idp ?>&idr=<?php echo $idr ?>" />
