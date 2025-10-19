<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>
<?php



if (isset($_POST['NOMBRE'])) {
$nombre=$_POST['NOMBRE'];
$F_INICIO= $_POST['fechaInicio'];
$F_FIN= $_POST['fechaFin'];

} else  {
  $fecha = $_GET['f'];
  $nombre=$_GET['n'];
  $F_INICIO= $fecha;
  $F_FIN= $fecha;
}


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
    <span class="icon-truck"></span>  REPORTE DE RENDICIONES - CONTROL DE CAJA 
    </B></h4>

<div class="dropdown-divider"></div> 

<style>
  .form-container {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}


</style>


<div style="display: flex; justify-content: space-between;">
  <div class="form-container" style="text-align: right;">


       <form action="segimientos_rendicion.php" method="post">
        <label for="NOMBRE">Nombre:</label>
        <input list="NOMBRES" type="text" id="NOMBRE" name="NOMBRE" value='<?php echo $nombre?>'placeholder="Conductor " required >
          <datalist id="NOMBRES" >  
          <option selected ></option>
              <?php               

                $queryP="SELECT user_nombre, user_disponible FROM usuarios WHERE user_activo ='si' ";
                $resultP=mysqli_query($conexion, $queryP);
              ?>
              <?php while($filasP=mysqli_fetch_assoc($resultP)) { ?>
                
          <option value="<?php echo $filasP ['user_nombre']?>" >
          </option>
          <?php } ?>
          </datalist>

        <label for="fechaInicio">F. Inicio:</label>
        <input type="date" id="fechaInicio" name="fechaInicio" value="<?php echo $F_INICIO?>" required>

        <label for="fechaFin">F. Fin:</label>
        <input type="date" id="fechaFin" name="fechaFin"  value="<?php echo $F_FIN?>" required>

        <input type="submit" value=" BUSCAR " class="btn btn-primary">
    </form>

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

SELECT rd_segimientos_head.S_FECHA, rd_operadores.Id_SERG, rd_operadores.TIPO_OP, rd_operadores.NOMBRE, diario.DEBE, diario.HABER, diario.SALDO, rd_operadores.ID_OPERA, rd_segimientos_head.PLACA, diario.GLOSA, diario.KILOMETRAJE, diario.MEDIDA, diario.CANTIDAD, diario.TIPO_DOC, diario.NRO_DOC, diario.FECHA_DOC, pcge.CTA_NOMBRE, pcge.DOSDIGITOS
FROM ((rd_operadores LEFT JOIN diario ON rd_operadores.ID_OPERA = diario.ID_OPERA) INNER JOIN rd_segimientos_head ON rd_operadores.Id_SERG = rd_segimientos_head.Id_SERG) INNER JOIN pcge ON diario.CTA_CONT = pcge.ID_CTA
WHERE (((rd_segimientos_head.S_FECHA)>='$F_INICIO' And (rd_segimientos_head.S_FECHA)<='$F_FIN') AND ((rd_operadores.NOMBRE)='$nombre') AND ((pcge.DOSDIGITOS)=14))
ORDER BY rd_segimientos_head.S_FECHA;


";
$resultCC=mysqli_query($conexion, $queryCC);

?>
 

<div class="container">
  <div class="row">
    <div class="col-sm">
<h5>NOMBRE: <?php echo $nombre ?></h5>  
<h5>REPORTE: <?php echo $F_INICIO ?> AL <?php echo $F_FIN?></h5>
<table id="example" class="table table-striped table-sm">
  <thead  class="thead-dark">
    <tr>
      <th scope="col">FECHA</th>
      <th scope="col">PLACA</th>
      <th scope="col">DECRIPCION</th>
       <th scope="col">KILOMETRAJE</th>
        <th scope="col">CANTIDAD</th>
         <th scope="col">DOCUMENTO</th>
      <th scope="col">ENTREGADO</th>
      <th scope="col">RENDIDO</th>
      <th scope="col">SALDO</th>
      

      
    </tr>
  </thead>
  <tbody>
  
      <?php while($filasCC=mysqli_fetch_assoc($resultCC)) { ?>

      <tr>       

      <td>
        <?php echo $filasCC ['FECHA_DOC']  ?> 
      </td>
     
      <td>
        <?php echo $filasCC ['PLACA']  ?> 

      </td>

      <td>
        <?php echo $filasCC ['GLOSA']  ?>

      </td>
      <td>
        <?php echo $filasCC ['KILOMETRAJE']  ?>

      </td>
      <td>
        <?php echo $filasCC ['CANTIDAD']  ?> <?php echo $filasCC ['MEDIDA']  ?>

      </td>

      <td>
        <?php echo $filasCC ['TIPO_DOC']  ?> 
        <?php echo $filasCC ['NRO_DOC']  ?>

      </td>

      <td class="text-right">
        <?php echo $filasCC ['DEBE']  ?>

      </td >
            <td class="text-right">
        <?php echo $filasCC ['HABER']  ?>

      </td>

      <td class="text-right">
        <?php echo $filasCC ['SALDO']  ?>

      </td>

   
      </tr>
    <?php } ?>

 <?php
$querySS="

SELECT rd_segimientos_head.S_FECHA, rd_operadores.NOMBRE, Sum(diario.DEBE) AS SumaDeDEBE, Sum(diario.HABER) AS SumaDeHABER, Sum(diario.SALDO) AS SumaDeSALDO, pcge.DOSDIGITOS
FROM ((rd_operadores LEFT JOIN diario ON rd_operadores.ID_OPERA = diario.ID_OPERA) INNER JOIN rd_segimientos_head ON rd_operadores.Id_SERG = rd_segimientos_head.Id_SERG) INNER JOIN pcge ON diario.CTA_CONT = pcge.ID_CTA
GROUP BY rd_segimientos_head.S_FECHA, rd_operadores.NOMBRE, pcge.DOSDIGITOS
HAVING (((rd_segimientos_head.S_FECHA)>='$F_INICIO' And (rd_segimientos_head.S_FECHA)<='$F_FIN') AND ((rd_operadores.NOMBRE)='$nombre') AND ((pcge.DOSDIGITOS)=14))
ORDER BY rd_operadores.NOMBRE;


";
$resultSS=mysqli_query($conexion, $querySS);
$filasSS=mysqli_fetch_assoc($resultSS);
?>
 <tr style="color: white; background-color:  #14b0f5 ; font-size: 16px; font-weight: bold;">
      <td>TOTALES</td>     
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>

      <td class="text-right">
        <?php echo $filasSS ['SumaDeDEBE']  ?>
      </td >

      <td class="text-right">
        <?php echo $filasSS ['SumaDeHABER']  ?>
      </td>

      <td class="text-right">
        <?php echo $filasSS ['SumaDeSALDO']  ?>
      </td>
 </tr>
  
  </tbody>
</table>



    </div>
  </div>
</div>



<?php include('includes/footer.php'); ?>