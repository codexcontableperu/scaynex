
<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
<?php include("../data/conexion.php"); ?>
<?php include('includes/menubar.php'); ?>



<?php
$idp=$_GET['idp'];
$query="
SELECT programaciones.id_prog, cuentas.cta_nombrecomercial, programaciones.id_habilidad
FROM programaciones INNER JOIN cuentas ON programaciones.id_cta = cuentas.id_cta
WHERE (((programaciones.id_prog)=$idp))

";
     $result=mysqli_query($conexion, $query);
     $filas=mysqli_fetch_assoc($result);
?>
<br>

<div class="container p-3">
<h4> RUTAS GENERADAS </h4>

</div>
<br>
<div class="container">
  <div class="row">

    <div class="col-sm">

        <div class="card">
          <div class="card-body text-center">

<form  action="crud_ruta/create.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="id_user" name="id_user" value="<?php echo $id_userup ; ?> " readonly>
<input class="form-control"  type="hidden" id="id_prog" name="id_prog" value="<?php echo $filas ['id_prog'] ; ?> " readonly>
<input class="form-control"  type="hidden" id="cta_nombrecomercial" name="cta_nombrecomercial" value="<?php echo $filas ['cta_nombrecomercial'] ; ?> " readonly>
<button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">GENERAR NUEVA RUTA</button>
  
</form>



          </div>
        </div>

    </div>
  </div>
</div>




<?php
     $query2="
SELECT hruta.estado_hr, hruta.id_ruta, hruta.id_prog, hruta.fechahr, hruta.ruta_glosa
FROM hruta
WHERE id_prog=$idp
                ";
     $result2=mysqli_query($conexion, $query2);
     
?>


<br>
<div class="container">
  <div class="row">

    <div class="col-sm">

        <table class="table table-bordered table-sm  text-center " >

          <?/*---contenido de la tabla---*/?>

          <tbody>

            <?php while($filas2=mysqli_fetch_assoc($result2)) { ?>
                <tr>
                  <td class="">
                   <span class="icon-truck"></span>
                    RUTA: 00<?php echo $filas2 ['id_ruta'];?> 

                    <?php 
                    if ($filas2 ['estado_hr']==0) {
                       $ESTAD="  Abierto  "; 
                        ?> <br> <a href="ruta_close.php?idp=<?php echo $filas2 ['id_prog']?>&idr=<?php echo $filas2 ['id_ruta']?>" class=" btn-success"> &nbsp <?php echo $ESTAD;?> &nbsp </a><?php
                    } else {
                       $ESTAD="  Cerrado  ";
                        ?><br> <a href="ruta_close.php?idp=<?php echo $filas2 ['id_prog']?>&idr=<?php echo $filas2 ['id_ruta']?>" class=" btn-danger ">  &nbsp <?php echo $ESTAD;?> &nbsp </a><?php
                    
                    }?>
                    
                    &nbsp <a href="crud_ruta/delete.php?idp=<?php echo $filas2 ['id_prog']?>&idr=<?php echo $filas2 ['id_ruta']?>" class=" btn-danger" type="button"> <span class="icon-bin "> </span></a>

                   <br>

                  </td> 

                  <td class="">
                    
                     <?php echo $filas2 ['ruta_glosa'];?>
                  </td>      
                  
                 <td>
                    <div class="container text-center ">
                        <a href="ruta_create_read.php?idp=<?php echo $filas2 ['id_prog']?>&idr=<?php echo $filas2 ['id_ruta']?>"  type="button" class="btn btn-primary " ><span class="icon-folder-plus"></span> </a> 
                    </div>
                 </td>
                 
                </tr>
             <?php } ?>

          </tbody>
        </table>

    </div>
  </div>
</div>



<?php include('includes/footer.php'); ?>


