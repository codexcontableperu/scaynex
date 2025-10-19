 
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">

<?php include('includes/header.php'); ?>
<?php include("../data/conexion.php"); ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<?php

if (isset($_GET['idg'])) {
  $x = $_GET['idg'];

     $query="

SELECT guias_remitente.id_guiar, guias_remitente.gr_serienum, guias_remitente.emp_destino, emp_destino.emp_destino AS empresa, guias_remitente.origen_distrito, distritos.distrito AS origen, guias_remitente.destino_distrito, distritos_1.distrito AS destino, guias_remitente.fact_cliente, guias_remitente.gr_bultos, guias_remitente.gr_obs
FROM ((guias_remitente INNER JOIN emp_destino ON guias_remitente.emp_destino = emp_destino.id_emp) INNER JOIN distritos ON guias_remitente.origen_distrito = distritos.id_distrito) INNER JOIN distritos AS distritos_1 ON guias_remitente.destino_distrito = distritos_1.id_distrito
WHERE (((guias_remitente.id_guiar)='$x'))

        ";
     $result=mysqli_query($conexion, $query);
     $filas=mysqli_fetch_assoc($result);
$ido = $filas['origen_distrito'] ;
$orig= $filas['origen'] ;
$idd = $filas['destino_distrito'] ;
$dest = $filas['destino'];
$bultos= $filas['gr_bultos'];
$obs = $filas['gr_obs'];


?>



   <?/*---formulario tabla---*/?>

<span class="icon-checkbox-checked"></span> <B> GUIAS DE REMISION:</B>  <br>



<form  action="crud_guiarem/create.php" method="POST" enctype="multipart/form-data" class="colm">

  <div class="form-group" >
    <label for="gr_serienum">SERIE - NUMERO :  </label>
    <input class="form-control" type="text"  id="gr_serienum" name="gr_serienum" value="<?php echo $filas['gr_serienum']?>" required> 
  </div>

  <div class="form-group" >
    <label for="fact_cliente">FACTURA :  </label>
    <input class="form-control" type="text"  id="fact_cliente" name="fact_cliente" value="<?php echo $filas['fact_cliente']?>" required> 
  </div>





<div class="form-group">

  <label for="emp_destino">CLIENTE : </label>        


              <select id="bus-bb" class="custom-select" id="emp_destino" name="emp_destino" required>
                <option selected value="<?php echo $filas ['emp_destino'] ?>"> <?php echo $filas ['empresa'] ?> </option>
                <?php 
                  $cta = $filas4 ['id_cta'];
                  $query="SELECT * FROM emp_destino ORDER BY emp_destino";
                  $result=mysqli_query($conexion, $query);
                ?>
                <?php while($filas=mysqli_fetch_assoc($result)) { ?>
                  
                <option value="<?php echo $filas ['id_emp']?>" >
                  <?php echo $filas ['emp_destino']  ?>
                </option>
                <?php } ?>
                
              </select>
              <script type="text/javascript" >
                $('#bus-bb').select2();
              </script>


</div>
  

<div class="form-group">
  <label for="origen_distrito">ORIGEN : </label>
              <select class="custom-select" id="origen_distrito" name="origen_distrito" required>
                <option selected value="<?php echo $ido ?>"> <?php echo $orig ?> </option>

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
</div>

<div class="form-group">
  <label for="destino_distrito">DESTINO : </label>

              <select class="custom-select" id="destino_distrito" name="destino_distrito" required>
              <option selected value="<?php echo $idd ?>"> <?php echo $dest ?> </option>
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

</div>



  <div class="form-group" >
    <label for="gr_bultos">BULTOS :  </label>
    <input class="form-control" type="number"  id="gr_bultos" name="gr_bultos" value="<?php echo $bultos ?>" required>
  </div>

  <div class="form-group" >
    <label for="gr_obs">OBSERVACIONES :  </label>
   <input class="form-control" type="text"  id="gr_obs" name="gr_obs" value="<?php echo $obs ?>" >   
  </div>

<button type="submit" class="btn btn-success btn-lg btn-block" id="guardar" name="guardar">ACTUALIZAR</button>
</form>


<?php


} else {
?>

<?php  

$idp = $_GET['idp'];  
$idr = $_GET['idr']; 

?>

   <?/*---formulario tabla---*/?>

<span class="icon-checkbox-checked"></span> <B> GUIAS DE REMISION:</B>  <br>

<form  action="crud_guiarem/create.php" method="POST" enctype="multipart/form-data" class="colm">

<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>

  <div class="form-group" >
    <label for="gr_serienum">SERIE - NUMERO :  </label>
    <input class="form-control" type="text"  id="gr_serienum" name="gr_serienum" required> 
  </div>

  <div class="form-group" >
    <label for="fact_cliente">FACTURA :  </label>
    <input class="form-control" type="text"  id="fact_cliente" name="fact_cliente" required> 
  </div>

<div class="form-group">
  <label for="origen_distrito">ORIGEN : </label>
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
</div>

<div class="form-group">
  <label for="emp_destino">CLIENTE : </label>

              <select id="bus-bb" class="custom-select" id="emp_destino" name="emp_destino" required>
                <option selected></option>
                <?php 
                  $cta = $filas4 ['id_cta'];
                  $query="SELECT * FROM emp_destino ORDER BY emp_destino";
                  $result=mysqli_query($conexion, $query);
                ?>
                <?php while($filas=mysqli_fetch_assoc($result)) { ?>
                  
                <option value="<?php echo $filas ['id_emp']?>" >
                  <?php echo $filas ['emp_destino']  ?>
                </option>
                <?php } ?>
              </select>

              <script type="text/javascript" >
                $('#bus-bb').select2();

              </script>
</div>
<a href="#ncliente" class="btn btn-light btn-block" data-toggle="modal"> 
          <span class="icon-pencil"></span> Nuevo Cliente         </a>

<div class="form-group">
  <label for="destino_distrito">DESTINO : </label>

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

</div>



  <div class="form-group" >
    <label for="gr_bultos">BULTOS :  </label>
    <input class="form-control" type="number"  id="gr_bultos" name="gr_bultos" required>
  </div>

  <div class="form-group" >
    <label for="gr_obs">OBSERVACIONES :  </label>
   <input class="form-control" type="text"  id="gr_obs" name="gr_obs" >   
  </div>

<button type="submit" class="btn btn-primary btn-lg btn-block" id="guardar" name="guardar">REGISTRAR</button>
</form>


<?php

}

?>

  

  
<div class="modal" tabindex="-1" role="dialog" id="ncliente">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">NUEVO CLIENTE: </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
<form  action="crud_empdest/create.php" method="POST" enctype="multipart/form-data" class="colm">
<input class="form-control"  type="hidden" id="idp" name="idp" value="<?php echo $idp ; ?> " readonly>
<input class="form-control"  type="hidden" id="idr" name="idr" value="<?php echo $idr ; ?> " readonly>

  <div class="form-group" >
    <label for="head_fecha">Ingrese: </label> <br>
    RUC: <input class="form-control" type="text"  id="ruc" name="ruc" required>
    EMPRESA: <input class="form-control" type="text"  id="empresa" name="empresa" required>
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


