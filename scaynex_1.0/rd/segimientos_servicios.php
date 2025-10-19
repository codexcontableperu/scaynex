<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>
<?php

if (isset($_POST['f'])) {
  $fecha = $_POST['f'];

} else  {
  $fecha = $_GET['f'];

}


$query="
SELECT rd_segimientos_head.*, rd_segimientos_head.S_FECHA
FROM rd_segimientos_head
WHERE (((rd_segimientos_head.S_FECHA)='$fecha'))";
$result=mysqli_query($conexion, $query);

?>

<style>
  .form-inline {
  justify-content: flex-end;
}

.btn-primary {
  margin-left: 10px;
}


</style>


<div class="card text-center">
  <div class="card-header">
    <B><h4>
    <span class="icon-truck"></span>  REPORTE DIARIO - CONTROL DE SERVICIOS <?php echo $fecha ?>
    </B></h4>

<div class="dropdown-divider"></div> 

<style>
  .form-container {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}


</style>
<?php
$queryT="
SELECT Count(rd_segimientos_head.Id_SERG) AS CuentaDeId_SERG, rd_segimientos_head.S_FECHA
FROM rd_segimientos_head
GROUP BY rd_segimientos_head.S_FECHA
HAVING (((rd_segimientos_head.S_FECHA)='$fecha'))";
$resultT=mysqli_query($conexion, $queryT);
$filasT=mysqli_fetch_assoc($resultT);

?>
<?php
$queryTS="
SELECT rd_segimientos_head.S_FECHA, Count(rd_servicio.Id_SERV) AS CuentaDeId_SERV
FROM rd_segimientos_head INNER JOIN rd_servicio ON rd_segimientos_head.Id_SERG = rd_servicio.Id_SERG
GROUP BY rd_segimientos_head.S_FECHA
HAVING (((rd_segimientos_head.S_FECHA)='$fecha'))
";
$resultTS=mysqli_query($conexion, $queryTS);
$filasTS=mysqli_fetch_assoc($resultTS);

?>

<?php
$queryEF="
SELECT rd_segimientos_head.S_FECHA, Count(rd_operadores.Id_SERG) AS CuentaDeId_SERV, Sum(EFECTIVO + YAPE + PLIN + OTROEF) AS TOTALEF
FROM rd_segimientos_head INNER JOIN rd_operadores ON rd_segimientos_head.Id_SERG = rd_operadores.Id_SERG
GROUP BY rd_segimientos_head.S_FECHA
HAVING (((rd_segimientos_head.S_FECHA)='$fecha'));

";
$resultEF=mysqli_query($conexion, $queryEF);
$filasEF=mysqli_fetch_assoc($resultEF);

?>





<div style="display: flex; justify-content: space-between;">
  <div class="form-container" style="text-align: right;">
    <a href="segimientos_caja.php?f=<?php echo $fecha ?>">
    <button  type="button" class="btn btn-outline-primary">EFECTIVO DEL DIA: S/.<?php echo $filasEF ['TOTALEF'] ?>      
    </button>
    </a>
    &nbsp
    <a href="">
    <button type="button" class="btn btn-outline-success">VIAJES DEL DIA: 0<?php echo $filasT ['CuentaDeId_SERG'] ?>
    </button>
    </a>
    &nbsp
    <a href="segimientos_servicios.php?f=<?php echo $fecha ?>">
    <button type="button" class="btn btn-outline-dark">SERVICIOS DEL DIA: 0<?php echo $filasTS ['CuentaDeId_SERV'] ?>      
    </button>
    </a>
  </div>

  <div class="form-container text-right" style="text-align: left;">

        <a href="segimientos_read.php?f=<?php echo $FECHAW ?>" style="color: white ;" type="button" class="btn btn-secondary mb-2">
          <span class="icon-reply "></span> CERRAR
        </a>
  </div>
</div>


  </div>
</div>





<div class="dropdown-divider"></div> 

<?php
$queryCC="

SELECT rd_segimientos_head.S_FECHA, rd_servicio.Id_SERV, rd_servicio.TEMPERATURA, rd_servicio.PLACA, rd_servicio.CUENTA, rd_servicio.CLIENTE, rd_servicio.H_CITA, rd_servicio.NRO_GUIA
FROM rd_segimientos_head INNER JOIN rd_servicio ON rd_segimientos_head.Id_SERG = rd_servicio.Id_SERG
WHERE (((rd_segimientos_head.S_FECHA)='$fecha'));



";
$resultCC=mysqli_query($conexion, $queryCC);

?>

<div class="container">
  <div class="row">
    <div class="col-sm">

<table id="example" class="table table-striped table-sm">
  <thead  class="thead-dark">
    <tr>
      <th scope="col">CARGA</th>
      <th scope="col">PLACA</th>
      <th scope="col">CUENTA</th>
      <th scope="col">CLIENTE</th>
      <th scope="col">CITA</th>
      <th scope="col">Nro_GUIA</th>

      
    </tr>
  </thead>
  <tbody>
  
      <?php while($filasCC=mysqli_fetch_assoc($resultCC)) { ?>
      <tr>       

      <td>
        <?php echo $filasCC ['TEMPERATURA']  ?> 
      </td>
      <td>
        <?php echo $filasCC ['PLACA']  ?> 

      </td>
      <td>
        <?php echo $filasCC ['CUENTA']  ?>

      </td>
      <td>
        <?php echo $filasCC ['CLIENTE']  ?>

      </td>
      <td>
        <?php echo $filasCC ['H_CITA']  ?>

      </td>
      <td>
        <?php echo $filasCC ['NRO_GUIA']  ?>

      </td>
    
      </tr>
    <?php } ?>
  
  </tbody>
</table>



    </div>
  </div>
</div>


<?php include('includes/footer.php'); ?>


