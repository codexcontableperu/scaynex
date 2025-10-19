

<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">

<?php include('includes/header.php'); ?>
<?php include("../data/conexion.php"); ?>


<?php
$idp=$_GET['idp'];
$idr=$_GET['idr'];
     $query2="
SELECT *
FROM hruta
 /* WHERE id_prog=$idp */
WHERE id_ruta=$idr
                ";
     $result2=mysqli_query($conexion, $query2);
     $filas2=mysqli_fetch_assoc($result2);


     $query3="
SELECT *
FROM hruta
WHERE id_ruta=$idr
                ";
     $result3=mysqli_query($conexion, $query3);
     $filas3=mysqli_fetch_assoc($result3);


     $query4="
SELECT serie_guiatrans , num_guiatrans ,id_prog ,id_cta 
FROM programaciones
WHERE id_prog=$idp
                ";
     $result4=mysqli_query($conexion, $query4);
     $filas4=mysqli_fetch_assoc($result4);

     $query5="
SELECT id_ruta
FROM guias_remitente
WHERE id_ruta=$idr
                ";
     $result5=mysqli_query($conexion, $query5);
     $filas5=mysqli_fetch_assoc($result5);

?>



<h5 style="background-color: #f1f2f6 ; padding: 20px ;"><span class="icon-truck"></span> &nbsp <?php echo $filas2 ['ruta_glosa'];?></h5>

<table class="table table-sm table-dark">

  <tbody>
    <tr>
      <th scope="row">1</th>
      <td> <span class="icon-home"></span> &nbsp INICIO</td>
      <td>
          <div class="container text-center ">

     <?php            
     if ($filas2 ['h_inicio'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=1" class="btn btn-light"> 
              <span class="icon-clock2"></span>
            </a>
          <?php
     } else {
          ?> 
            <a href="#h_inicio" class="btn btn-primary" data-toggle="modal"> 
              <span class="icon-clock2"></span>
            </a>
          <?php

     }


     if ($filas2 ['t_inicio'] === null ) {
          ?> 
             <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=12" class="btn btn-light"> 
              <span class="icon-text-height"></span>
              </a>
          <?php
     } else {
          ?> 
            <a href="#t_inicio" class="btn btn-danger" data-toggle="modal">
              <span class="icon-text-height"></span>
              </a> 
          <?php

     }


            
     ?>


          </div>
      </td>
    </tr>

    <tr>
      <th scope="row "> 2</th>
      <td><span class="icon-road"></span> &nbsp SALIDA SE BASE</td>
      <td>

<div class="container text-center ">        
<?php

     if ($filas2 ['h_salidabase'] === null ) {
          ?> 
          <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=2" class="btn btn-light"> 
          <span class="icon-clock2"></span>
          </a> 
          <?php
     } else {
          ?> 
            <a href="#h_salidabase" class="btn btn-primary" data-toggle="modal">
          <span class="icon-clock2"></span>
          </a> 
          <?php

     }


     if ($filas2 ['t_salidabase'] === null ) {
          ?> 
          <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=22" class="btn btn-light"> 
           <span class="icon-text-height"></span>
           </a>
          <?php
     } else {
          ?> 
          <a href="#t_salidabase" class="btn btn-danger" data-toggle="modal"> 
           <span class="icon-text-height"></span>
           </a>
          <?php

     }

     if ($filas2 ['k_salidabase'] === null ) {
          ?> 
          <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=20" class="btn btn-light"> 
           <span class="icon-road"></span>
           </a>
          <?php
     } else {
          ?> 
          <a href="#k_salidabase" class="btn btn-warning" data-toggle="modal"> 
           <span class="icon-road"></span>
           </a>
          <?php

     }


 ?>

          </div>
      </td>
    </tr>

    <tr>
      <th scope="row">3</th>
      <td><span class="icon-truck"></span> &nbspLLEGADA A ORIGEN</td>
      <td>
          <div class="container text-center ">


<?php

     if ($filas2 ['h_llegadaorigen'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=3" class="btn btn-light"> 
              <span class="icon-clock2"></span>
            </a> 
          <?php
     } else {
          ?> 
            <a href="#h_llegadaorigen" class="btn btn-primary" data-toggle="modal">
              <span class="icon-clock2"></span>
            </a> 
          <?php

     }


     if ($filas2 ['t_llegadaorigen'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=33" class="btn btn-light"> 
              <span class="icon-text-height"></span>
              </a>
          <?php
     } else {
          ?> 
            <a href="#t_llegadaorigen" class="btn btn-danger" data-toggle="modal">
              <span class="icon-text-height"></span>
              </a>
          <?php

     }

     if ($filas2 ['k_llegadaorigen'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=30" class="btn btn-light"> 
              <span class="icon-road"></span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#k_llegadaorigen" class="btn btn-warning" data-toggle="modal">
              <span class="icon-road"></span>
              </a>
          <?php

     }


 ?>


          </div>
      </td>
    </tr>

    <tr>
      <th scope="row">GR</th>
      <td><span class="icon-file-text"></span> &nbsp GUIAS DE REMISION</td>
      <td>
          <div class="container text-center ">

           <?php            
           if ($filas5 ['id_ruta'] === null ) {
                ?> 
                  <a href="#guiarem" class="btn btn-light" data-toggle="modal"> 
                    &nbsp REGISTRAR &nbsp
                  </a>
                <?php
           } else {
                ?> 
                  <a href="#guiarem" class="btn btn-primary" data-toggle="modal"> 
                    &nbsp REGISTRAR &nbsp
                  </a>
                <?php

           }

          ?> 


          </div>
      </td>
    </tr>

    <tr>
      <th scope="row">GT</th>
      <td><span class="icon-file-text"></span> &nbsp GUIA TRNSPORTISTA</td>
      <td>
          <div class="container text-center ">

     <?php            
     if ($filas4 ['num_guiatrans'] === null ) {
          ?> 
            <a href="#guiatrans" class="btn btn-light" data-toggle="modal"> 
              &nbsp REGISTRAR &nbsp
            </a>
          <?php
     } else {
          ?> 
            <a href="#guiatrans" class="btn btn-primary" data-toggle="modal"> 
              &nbsp REGISTRAR &nbsp
            </a>
          <?php

     }

    ?> 


            

          </div>
      </td>
    </tr>


    <tr>
      <th scope="row">4</th>
      <td><span class="icon-cart"></span> &nbspINICIO CARGA</td>
      <td>
          <div class="container text-center ">

     <?php            
     if ($filas2 ['h_iniciocarga'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=4" class="btn btn-light"> 
              <span class="icon-clock2"></span>
            </a>
          <?php
     } else {
          ?> 
          <a href="#h_iniciocarga" class="btn btn-primary" data-toggle="modal">
              <span class="icon-clock2"></span>
            </a>
          <?php

     }


     if ($filas2 ['t_iniciocarga'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=44" class="btn btn-light"> 
              <span class="icon-text-height"></span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#t_iniciocarga" class="btn btn-danger" data-toggle="modal">
              <span class="icon-text-height"></span>
              </a>
          <?php

     }
        
     ?>
  
          </div>
      </td>
    </tr>

    <tr>
      <th scope="row">5</th>
      <td><span class="icon-road"></span> &nbspSALIDA ORIGEN</td>
      <td>
          <div class="container text-center ">

     <?php            
     if ($filas2 ['h_salidaorigen'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=5" class="btn btn-light"> 
              <span class="icon-clock2"></span>
            </a>
          <?php
     } else {
          ?> 
          <a href="#h_salidaorigen" class="btn btn-primary" data-toggle="modal">
              <span class="icon-clock2"></span>
            </a>
          <?php

     }


     if ($filas2 ['t_salidaorigen'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=55" class="btn btn-light"> 
              <span class="icon-text-height"></span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#t_salidaorigen" class="btn btn-danger" data-toggle="modal">
              <span class="icon-text-height"></span>
              </a>
          <?php

     }
        
     ?>





          </div>
      </td>
    </tr>

        <tr>
      <th scope="row">6</th>
      <td><span class="icon-truck"></span> &nbspLLEGADA DESTINO</td>
      <td>
          <div class="container text-center ">

<?php

     if ($filas3 ['h_llegadadestino'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=6" class="btn btn-light"> 
              <span class="icon-clock2"></span>
            </a>
          <?php
     } else {
          ?> 
          <a href="#h_llegadadestino" class="btn btn-primary" data-toggle="modal">
              <span class="icon-clock2"></span>
            </a>
          <?php

     }


     if ($filas3 ['t_llegadadestino'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=66" class="btn btn-light"> 
              <span class="icon-text-height"></span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#t_llegadadestino" class="btn btn-danger" data-toggle="modal">
              <span class="icon-text-height"></span>
              </a>
          <?php

     }

     if ($filas3 ['k_llegadadestino'] === null ) {
          ?> 
              <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=60" class="btn btn-light"> 
              <span class="icon-road"></span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#k_llegadadestino" class="btn btn-warning" data-toggle="modal">
              <span class="icon-road"></span>
              </a>
          <?php

     }


 ?>

          </div>
      </td>
    </tr>

    <tr>
      <th scope="row">7</th>
      <td><span class="icon-cart"></span> &nbspINICIO DESCARGA</td>
      <td>
          <div class="container text-center ">

     <?php            
     if ($filas3 ['h_iniciodescarga'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=7" class="btn btn-light"> 
              <span class="icon-clock2"></span>
            </a>
          <?php
     } else {
          ?> 
          <a href="#h_iniciodescarga" class="btn btn-primary" data-toggle="modal">
              <span class="icon-clock2"></span>
            </a>
          <?php

     }


     if ($filas3 ['t_iniciodescarga'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=77" class="btn btn-light"> 
              <span class="icon-text-height"></span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#t_iniciodescarga" class="btn btn-danger" data-toggle="modal">
              <span class="icon-text-height"></span>
              </a>
          <?php

     }
        
     ?>




          </div>
      </td>
    </tr>

    <tr>
      <th scope="row">8</th>
      <td><span class="icon-loop2"></span> &nbspRETORNO</td>
      <td>
          <div class="container text-center ">


<?php

     if ($filas2 ['h_retorno'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=8" class="btn btn-light"> 
              <span class="icon-clock2"></span>
            </a>
          <?php
     } else {
          ?> 
          <a href="#h_retorno" class="btn btn-primary" data-toggle="modal">
              <span class="icon-clock2"></span>
            </a>
          <?php

     }


     if ($filas2 ['t_retorno'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=88" class="btn btn-light"> 
              <span class="icon-text-height"></span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#t_retorno" class="btn btn-danger" data-toggle="modal">
              <span class="icon-text-height"></span>
              </a>
          <?php

     }

     if ($filas2 ['k_retorno'] === null ) {
          ?> 
            <a href="./crud_ruta/update.php?idp=<?php echo $idp?>&idr=<?php echo $idr?>&i=80" class="btn btn-light"> 
              <span class="icon-road"></span>
              </a>
          <?php
     } else {
          ?> 
          <a href="#k_retorno" class="btn btn-warning" data-toggle="modal">
              <span class="icon-road"></span>
              </a>
          <?php

     }


 ?>


          </div>
      </td>
    </tr>

      <tr>
      <th scope="row">OBS</th>
      <td><span class="icon-file-text"></span> &nbsp OBSERVACION </td>
      <td>
          <div class="container text-center ">
<?php

     if ($filas3 ['ruta_obs'] === null ) {
          ?> 
            <a href="#ruta_obs" class="btn btn-light" data-toggle="modal"> 
              &nbsp REGISTRAR &nbsp
            </a> 
          <?php
     } else {
          ?> 
            <a href="#ruta_obs" class="btn btn-primary" data-toggle="modal"> 
              &nbsp REGISTRAR &nbsp
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
  
<form  action="crud_ruta/update2.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
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
  
<form  action="crud_ruta/update2.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>
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
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>

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


<div class="modal" tabindex="-1" role="dialog" id="guiarem">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">GUIA REMISION REMITENTE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_guiarem/create.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>

  <div class="form-group" >
    <label for="head_fecha">Ingrese: </label> <br>
    ORIGEN : 
              <select class="custom-select" id="origen_distrito" name="origen_distrito" required>
                <option selected></option>
                <?php 
                  $cta = $filas4 ['id_cta'];
                  $query="SELECT * FROM distritos ";
                  $result=mysqli_query($conexion, $query);
                ?>
                <?php while($filas=mysqli_fetch_assoc($result)) { ?>
                  
                <option value="<?php echo $filas ['id_distrito']?>" >
                  <?php echo $filas ['distrito']  ?>
                </option>
                <?php } ?>
              </select>

    SERIE - NUMERO : <input class="form-control" type="text"  id="gr_serienum" name="gr_serienum" required>

    CLIENTE : 
              <select class="custom-select" id="emp_destino" name="emp_destino" required>
                <option selected></option>
                <?php 
                  $cta = $filas4 ['id_cta'];
                  $query="SELECT * FROM emp_destino WHERE (((id_cta)='$cta')) ";
                  $result=mysqli_query($conexion, $query);
                ?>
                <?php while($filas=mysqli_fetch_assoc($result)) { ?>
                  
                <option value="<?php echo $filas ['id_emp']?>" >
                  <?php echo $filas ['emp_destino']  ?>
                </option>
                <?php } ?>
              </select>

    DESTINO  : 
              <select class="custom-select" id="destino_distrito" name="destino_distrito" required>
                <option selected></option>
                <?php 
                  $cta = $filas4 ['id_cta'];
                  $query="SELECT * FROM distritos ";
                  $result=mysqli_query($conexion, $query);
                ?>
                <?php while($filas=mysqli_fetch_assoc($result)) { ?>
                  
                <option value="<?php echo $filas ['id_distrito']?>" >
                  <?php echo $filas ['distrito']  ?>
                </option>
                <?php } ?>
              </select>


    FACTURA  : <input class="form-control" type="text"  id="fact_cliente" name="fact_cliente" required>
    BULTOS  : <input class="form-control" type="number"  id="gr_bultos" name="gr_bultos" required>   
    OBSERVACIONES  : <input class="form-control" type="text"  id="gr_obs" name="gr_obs" >   

  </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
</form>
        
      </div>
    </div>
  </div>
</div>











<?php include('includes/footer.php'); ?>