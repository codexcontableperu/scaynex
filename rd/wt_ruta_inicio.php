<?php
$idp=$_GET['idp'];

     $query2="
SELECT *
FROM rd_inicio_fin
 /* WHERE id_prog=$idp */
WHERE Id_SERG=$idp
                ";
     $result2=mysqli_query($conexion, $query2);
     $filas2=mysqli_fetch_assoc($result2);


?>

<table class="table table-sm " style="background-color:white;">

  <tbody>
<br>
<tr> &nbsp<span class="icon-truck"></span> &nbsp SALIDA DE BASE (Inicio)</tr>
    <tr>

      <td>

<div class=" text-center ">        
<?php

     if ($filas2 ['HORA_SALIDA_BASE'] === null ) {
          ?> 
          <a href="./crud_inicio_fin/updateIF.php?idp=<?php echo $idp?>&i=200" class="btn btn-light"> 
            <span class="icon-clock2"></span>
          </a> 
          <?php
     } else {
          ?> 
            <a href="#HORA_SALIDA_BASE" class="btn btn-primary" data-toggle="modal">
          <span class="icon-clock2"></span> <br>
          <small><?php echo date("H:i", strtotime($filas2['HORA_SALIDA_BASE']))?></small> 
          </a> 
          <?php

     }


     if ($filas2 ['TEMP_SALIDA_BASE'] === null ) {
          ?> 
          <a href="./crud_inicio_fin/updateIF.php?idp=<?php echo $idp?>&i=2200" class="btn btn-light"> 
           <span class="icon-text-height"></span>
           </a>
          <?php
     } else {
          ?> 
          <a href="#TEMP_SALIDA_BASE" class="btn btn-danger" data-toggle="modal"> 
           <span class="icon-text-height"></span><br>
           <small><?php echo $filas2['TEMP_SALIDA_BASE']?></small>
           </a>
          <?php

     }

     if ($filas2 ['KM_SALIDA_BASE'] === null ) {
          ?> 
          <a href="./crud_inicio_fin/updateIF.php?idp=<?php echo $idp?>&i=2000" class="btn btn-light"> 
           <span class="icon-road"></span>
           </a>
          <?php
     } else {
          ?> 
          <a href="#KM_SALIDA_BASE" class="btn btn-warning" data-toggle="modal"> 
           <span class="icon-road"></span><br>
           <small><?php echo $filas2['KM_SALIDA_BASE']?></small>
           </a>
          <?php

     }


     if ($filas2 ['FOTO_INICIO'] === "NO" ) {
          ?> 
          <a href="#FOTOS" class="btn btn-light" data-toggle="modal"> 
            <span class="icon-image"></span>
            
          </a> 
          <?php
     } else {
          ?> 
            <a href="#FOTOS" class="btn btn-primary" data-toggle="modal">
          <span class="icon-image"></span> <br>
          <small><?php echo $filas2['FOTO_INICIO']?></small> 
          </a> 
          <?php

     }



 
          ?> 
               <?php


// Consulta para calcular el saldo actual
$query_saldo = "SELECT IFNULL(SUM(saldo), 0) AS saldo_actual 
                FROM rd_control_cuentas 
                WHERE id_user = $id_userup AND estado = 0";

$result_saldo = mysqli_query($conexion, $query_saldo);
$row_saldo = mysqli_fetch_assoc($result_saldo);
$saldo_actual = number_format($row_saldo['saldo_actual'], 2);
?>








          <?php



     if ($filas2 ['rcaja'] === "no" ) {
          ?> 

          <a href="crud_gastos/control_rcaja.php?idp=<?php echo $idp?>" class="btn btn-light" > 
            <span class="icon-coin-dollar"></span> <br>
            <small><?php echo $saldo_actual?></small>
          </a>  
          <?php
     } else {
          ?> 

          <a href="wt_control_caja.php?idp=<?php echo $idp?>" class="btn btn-dark" > 
            <span class="icon-coin-dollar"></span> <br>
            <small><?php echo $saldo_actual?></small>
          </a> 
          <?php

     }


     if ($filas2 ['wt_inicio'] === null ) {
          ?> 
          <a href="./crud_inicio_fin/updateIF.php?idp=<?php echo $idp?>&i=1" class="btn btn-light" target="_blank"> 
           <span class="icon-whatsapp"></span>
           </a>
          <?php
     } else {
          ?> 
          <a  href="./crud_mensajes/msj_inicio.php?idp=<?php echo $idp?> " target="_blank"  class="btn btn-success" data-toggle="modal"> 
           <span class="icon-whatsapp"></span><br>
           <small style="font-size: 10px;" >ok</small>
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
SELECT *
FROM update2
WHERE tipo='h'
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
SELECT *
FROM update2
WHERE tipo='t'
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





<div class="modal" tabindex="-1" role="dialog" id="FOTOS">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> IMAGENES DE PARTIDA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_fotos/createimg.php" method="POST" enctype="multipart/form-data" class="colm">
<input class="form-control"  type="hidden" id="tipo" name="tipo" value="PARTIDA" readonly>
<input class="form-control"  type="hidden" id="Redirigir" name="Redirigir" value="panel_user" readonly>
<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="" readonly>  
<input class="form-control"  type="hidden" id="idd" name="idd" value="" readonly>

    <div class="form-group">
        <label for="head_imagen">Imagen: </label>

   <!-- Input oculto -->
<input type="file" 
       class="form-control d-none" 
       id="head_imagen" 
       name="head_imagen" 
       accept="image/*">

<!-- Botones con Bootstrap -->
<div class="d-flex gap-2 border rounded p-3 justify-content-center">
  <button type="button" class="btn btn-dark" onclick="openCameraEgr()">
    <i class="bi bi-camera-fill"></i> Cámara
  </button>
  
  <button type="button" class="btn btn-outline-dark" onclick="openGalleryEgr()">
    <i class="bi bi-folder2-open"></i> Galería
  </button>
</div>

<!-- Opcional: Mostrar nombre del archivo seleccionado -->
<small id="file-name-head" class="text-muted mt-2 d-block"></small>

<script>
  const fileInputhead = document.getElementById('head_imagen');
  const fileNamehead = document.getElementById('file-name-head');
  
  function openCameraEgr() {
    fileInputhead.setAttribute('capture', 'environment');
    fileInputhead.click();
  }
  
  function openGalleryEgr() {
    fileInputhead.removeAttribute('capture');
    fileInputhead.click();
  }
  
  fileInputhead.addEventListener('change', function() {
    if (this.files && this.files[0]) {
      fileNamehead.textContent = '📎 ' + this.files[0].name;
    }
  });
</script>






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



<!-- ============================================ -->


