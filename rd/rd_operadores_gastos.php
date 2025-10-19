<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>

<?php
$tabla = 'rd_operadores';

if (isset($_GET['rd'])) {
  $RD = $_GET['rd'];

  // Crear la consulta
  $query = "
SELECT rd_operadores.Id_SERG, rd_operadores.TIPO_OP, rd_operadores.NOMBRE, Sum(diario.DEBE) AS SumaDeDEBE, Sum(diario.HABER) AS SumaDeHABER, Sum(diario.SALDO) AS SumaDeSALDO, rd_operadores.ID_OPERA, pcge.DOSDIGITOS
FROM (rd_operadores LEFT JOIN diario ON rd_operadores.ID_OPERA = diario.ID_OPERA) INNER JOIN pcge ON diario.CTA_CONT = pcge.ID_CTA
GROUP BY rd_operadores.Id_SERG, rd_operadores.TIPO_OP, rd_operadores.NOMBRE, rd_operadores.ID_OPERA, pcge.DOSDIGITOS
HAVING (((rd_operadores.Id_SERG)='$RD') AND ((pcge.DOSDIGITOS)=14));





  ";
  $result = mysqli_query($conexion, $query);

// Generar tabla
?>

<div class="dropdown-divider"></div> 

<style>
  .form-container {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}


</style>
<div class="container">
  <div class="row">
    <div class="col-sm">
      <h5><span class="icon-folder-open "></span> PERSONAL ASIGNADO AL SERVICIO</h5>
      <div class="form-container text-right">

 
        <a href="segimientos_read.php?f=<?php echo $FECHAW ?>" style="color: white ;" type="button" class="btn btn-secondary mb-2">
          <span class="icon-reply "></span> REGRESAR
        </a>

      </div>
    </div>
  </div>
</div>

<div class="dropdown-divider"></div> 


<div class="container">
  <div class="row">
    <div class="col-sm">

<table id="example" class="table table-striped table-sm">
  <thead  class="thead-dark">
    <tr>
      <th scope="col">TIPO</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">ENTREGADO </th>
      <th scope="col">RENDIDO </th>
      <th scope="col">SALDO </th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  
      <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      <tr>       

      <td>
        <?php echo $filas ['TIPO_OP']  ?> 
      </td>
      <td>
        <?php echo $filas ['NOMBRE']  ?> 

      </td>
      
      <td>
       <?php echo $filas ['SumaDeDEBE']  ?>  

      </td>
       <td>
        <?php echo $filas ['SumaDeHABER']  ?>  

      </td>
      <td>

<?php echo $filas ['SumaDeSALDO']  ?>  
      </td>
      <td>


          <a href="rd_diario_nuevogasto.php?op=<?php echo $filas ['ID_OPERA'] ?>&rd=<?php echo $RD ?>" class="btn btn-primary"> 
          R. GASTOS
          </a>


       </td>     
      </tr>
    <?php } ?>
  
  </tbody>
</table>




    </div>
  </div>
</div>

<?php
}
?>


<?php include('includes/footer.php'); ?>