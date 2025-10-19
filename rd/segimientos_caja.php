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
SELECT rd_segimientos_head.S_FECHA, Count(rd_operadores.Id_SERG) AS CuentaDeId_SERG, Sum(diario.DEBE) AS SumaDeDEBE, pcge.DOSDIGITOS
FROM ((rd_segimientos_head INNER JOIN rd_operadores ON rd_segimientos_head.Id_SERG = rd_operadores.Id_SERG) LEFT JOIN diario ON rd_operadores.ID_OPERA = diario.ID_OPERA) INNER JOIN pcge ON diario.CTA_CONT = pcge.ID_CTA
GROUP BY rd_segimientos_head.S_FECHA, pcge.DOSDIGITOS
HAVING (((rd_segimientos_head.S_FECHA)='$fecha') AND ((pcge.DOSDIGITOS)=14));


";
$resultEF=mysqli_query($conexion, $queryEF);
$filasEF=mysqli_fetch_assoc($resultEF);

?>





<div style="display: flex; justify-content: space-between;">
  <div class="form-container" style="text-align: right;">
    <a href="segimientos_caja.php?f=<?php echo $fecha ?>">
    <button href="www.google.com" type="button" class="btn btn-outline-primary">EFECTIVO DEL DIA: S/.<?php echo $filasEF ['SumaDeDEBE'] ?>      
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

SELECT rd_segimientos_head.S_FECHA, rd_operadores.Id_SERG, rd_operadores.TIPO_OP, rd_operadores.NOMBRE, Sum(diario.DEBE) AS SumaDeDEBE, Sum(diario.HABER) AS SumaDeHABER, Sum(diario.SALDO) AS SumaDeSALDO, rd_operadores.ID_OPERA, rd_segimientos_head.PLACA, pcge.DOSDIGITOS
FROM ((rd_operadores LEFT JOIN diario ON rd_operadores.ID_OPERA = diario.ID_OPERA) INNER JOIN rd_segimientos_head ON rd_operadores.Id_SERG = rd_segimientos_head.Id_SERG) INNER JOIN pcge ON diario.CTA_CONT = pcge.ID_CTA
GROUP BY rd_segimientos_head.S_FECHA, rd_operadores.Id_SERG, rd_operadores.TIPO_OP, rd_operadores.NOMBRE, rd_operadores.ID_OPERA, rd_segimientos_head.PLACA, pcge.DOSDIGITOS
HAVING (((rd_segimientos_head.S_FECHA)='$fecha') AND ((pcge.DOSDIGITOS)=14))
ORDER BY rd_operadores.NOMBRE;



";
$resultCC=mysqli_query($conexion, $queryCC);

?>

<div class="container">
  <div class="row">
    <div class="col-sm">

<table id="example" class="table table-striped table-sm">
  <thead  class="thead-dark">
    <tr>
      <th scope="col">FECHA</th>
      <th scope="col">PLACA</th>
      <th scope="col">CARGO</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">ENTREGADO</th>
      <th scope="col">RENDIDO</th>
      <th scope="col">SALDO</th>
      <th scope="col"></th>

      
    </tr>
  </thead>
  <tbody>
  
      <?php while($filasCC=mysqli_fetch_assoc($resultCC)) { ?>
      <tr>       

      <td>
        <?php echo $filasCC ['S_FECHA']  ?> 
      </td>
      <td>
        <?php echo $filasCC ['PLACA']  ?> 

      </td>
      <td>
        <?php echo $filasCC ['TIPO_OP']  ?>

      </td>
      <td>
        <?php echo $filasCC ['NOMBRE']  ?>

      </td>
      <td>
        <?php echo $filasCC ['SumaDeDEBE']  ?>

      </td>
      <td>
        <?php echo $filasCC ['SumaDeHABER']  ?>

      </td>
      <td>
        <?php echo $filasCC ['SumaDeSALDO']  ?>

      </td>

      <td>
          <a href="segimientos_rendicion.php?n=<?php echo $filasCC ['NOMBRE'] ?>&f=<?php echo $fecha?>" class="btn btn-primary"> 
          REPORTE
          </a>

      </td>    
      </tr>
    <?php } ?>
  
  </tbody>
</table>



    </div>
  </div>
</div>



<?php include('includes/footer.php'); ?>