<?php
$idp=$_GET['idp'];

     $query2="
SELECT *
FROM rd_inicio_fin
WHERE Id_SERG=$idp ;
                ";
     $result2=mysqli_query($conexion, $query2);
     $filas2=mysqli_fetch_assoc($result2);


?>



<table class="table table-sm " style="background-color:white;">

  <tbody>
<br>
<tr> &nbsp<span class="icon-truck"></span> &nbsp RETORNO A BASE (Fin) </tr>

<tr>

      <td>
          <div class="container text-center ">


<?php

     if ($filas2 ['HORA_LLEGADA_BASE'] === null ) {
          ?> 
            <a href="./crud_inicio_fin/updateIF.php?idp=<?php echo $idp?>&i=800" class="btn btn-light"> 
              <span class="icon-clock2"></span>
            </a>
          <?php
     } else {
          ?> 
          <a href="#HORA_LLEGADA_BASE" class="btn btn-primary" data-toggle="modal">
              <span class="icon-clock2"></span><br>
              <small><?php echo date("H:i", strtotime($filas2['HORA_LLEGADA_BASE']))?></small> 
            </a>
          <?php

     }


     if ($filas2 ['TEMP_LLEGADA_BASE'] === null ) {
          ?> 
            <a href="./crud_inicio_fin/updateIF.php?idp=<?php echo $idp?>&i=8800" class="btn btn-light"> 
              <span class="icon-text-height"></span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#TEMP_LLEGADA_BASE" class="btn btn-danger" data-toggle="modal">
              <span class="icon-text-height"></span><br>
              <small><?php echo $filas2['TEMP_LLEGADA_BASE']?></small>
              </a>
          <?php

     }

     if ($filas2 ['KM_LLEGADA_BASE'] === null ) {
          ?> 
            <a href="./crud_inicio_fin/updateIF.php?idp=<?php echo $idp?>&i=8000" class="btn btn-light"> 
              <span class="icon-road"></span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#KM_LLEGADA_BASE" class="btn btn-warning" data-toggle="modal">
              <span class="icon-road"></span><br>
              <small><?php echo $filas2['KM_LLEGADA_BASE']?></small>
              </a>
          <?php

     }

     if ($filas2 ['FOTOS'] === "NO" ) {
          ?> 
          <a href="#FOTOSR" class="btn btn-light" data-toggle="modal"> 
            <span class="icon-image"></span><br>
            
          </a> 
          <?php
     } else {
          ?> 
            <a href="#FOTOSR" class="btn btn-primary" data-toggle="modal">
          <span class="icon-image"></span> <br>
          <small><?php echo $filas2['FOTOS']?></small> 
          </a> 
          <?php

     }






     if ($filas2 ['wt_fin'] === null ) {
          ?> 
          <a href="./crud_inicio_fin/updateIF.php?idp=<?php echo $idp?>&i=9" target="_blank" class="btn btn-light" > 
           <span class="icon-whatsapp"></span>
           </a>
          <?php
     } else {
          ?> 
          <a href="./crud_mensajes/msj_fin.php?idp=<?php echo $idp?>" class="btn btn-success" target="_blank"  data-toggle="modal" > 
           <span class="icon-whatsapp"></span> <br>
           <small style="font-size: 10px;" >Enviado</small>
           </a>
          <?php

     }

 ?>


          </div>
      </td>
    </tr>    


    
  </tbody>
</table>



<?php

     $query7="
SELECT  *
FROM update2
WHERE (((update2.tipo)='h') AND ((update2.activo)='si'));

                ";
     $result7=mysqli_query($conexion, $query7);



?>

  <?php while($filas7=mysqli_fetch_assoc($result7)) { ?>

<div class="modal" tabindex="-1" role="dialog" id="<?php echo $filas7 ['campo']?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo $filas7 ['titulo']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_inicio_fin/update2.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>

<input class="form-control"  type="hidden" id="i" name="i" value="<?php echo $filas7 ['indicador']?>" readonly>

  <div class="form-group" >
    <label for="head_fecha">Ingrese: </label>
    <input class="form-control" type="time"  id="txt" name="txt" required>
  </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
</form>
        
      </div>
    </div>
  </div>
</div>

   <?php } ?>



<?php

     $query7="
SELECT  *
FROM update2
WHERE (((update2.tipo)='t') AND ((update2.activo)='si'));
                ";
     $result7=mysqli_query($conexion, $query7);


?>

  <?php while($filas7=mysqli_fetch_assoc($result7)) { ?>

<div class="modal" tabindex="-1" role="dialog" id="<?php echo $filas7 ['campo']?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo $filas7 ['titulo']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_ruta/update2.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>

<input class="form-control"  type="hidden" id="i" name="i" value="<?php echo $filas7 ['indicador']?>" readonly>

  <div class="form-group" >
    <label for="head_fecha">Ingrese: </label>
    <input class="form-control" type="text"  id="txt" name="txt" required>
  </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
</form>
        
      </div>
    </div>
  </div>
</div>

   <?php } ?>


<div class="modal" tabindex="-1" role="dialog" id="guiatrans">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">GUIA REMISION TRANSPORTISTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_ruta/update3.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>

  <div class="form-group" >
    <label for="head_fecha">Ingrese: </label> <br>
    SERIE  : <input class="form-control" type="text"  id="serie_guiatrans" name="serie_guiatrans" required>
    NUMERO : <input class="form-control" type="text"  id="num_guiatrans" name="num_guiatrans" required>
  </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
</form>
        
      </div>
    </div>
  </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="FOTOSR">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> IMAGENES DE RETORNO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_fotos/createimg.php" method="POST" enctype="multipart/form-data" class="colm">
<input class="form-control"  type="hidden" id="tipo" name="tipo" value="RETORNO" readonly>
<input class="form-control"  type="hidden" id="Redirigir" name="Redirigir" value="panel_user" readonly>
<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="" readonly>  
<input class="form-control"  type="hidden" id="idd" name="idd" value="" readonly>

    <div class="form-group">
        <label for="head_imagen">Imagen: </label>
        <input class="form-control" type="file" id="head_imagen" name="head_imagen" accept="image/*" required>
        <label for="head_imagen">Descripción : </label>
        <input class="form-control" type="txt" id="ALCANCE" name="ALCANCE" required>
    </div>

      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">GUARDAR</button>
</form>






        
      </div>
    </div>
  </div>
</div>

