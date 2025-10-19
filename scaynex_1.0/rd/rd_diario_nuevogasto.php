<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>


   <?/*---formulario tabla---*/?>
<?php
$tabla = 'diario';

if (isset($_GET['rd'])) {
  $RD = $_GET['rd'];
  $OP = $_GET['op'];
// CONSULTA LISTA DE GASTOS REALIZADOS DE OPERADOR
  $query = "
SELECT diario.ID_DIARIO, diario.ID_OPERA, diario.Id_SERG, diario.CTA_CONT, diario.HABER, diario.FECHA_DOC, diario.GLOSA, pcge.CTA_NOMBRE, diario.DH, pcge.DOSDIGITOS
FROM diario INNER JOIN pcge ON diario.CTA_CONT = pcge.ID_CTA
WHERE (((diario.ID_OPERA)='$OP') AND ((diario.Id_SERG)='$RD') AND ((diario.HABER)>0) AND ((pcge.DOSDIGITOS)=14))
ORDER BY diario.ID_DIARIO DESC;




";
  $result = mysqli_query($conexion, $query);

// CONSULTA NOMBRE DE OPERADOR
  $queryOP = "SELECT * FROM rd_operadores WHERE ID_OPERA='$OP' ";
  $resultOP = mysqli_query($conexion, $queryOP);
  $filasOP=mysqli_fetch_assoc($resultOP);
  $NOMBREOP=$filasOP ['NOMBRE']; 

// CONSULTA SUMA DE GASTOS REALIZADOS
  $queryS = "

SELECT diario.ID_OPERA, diario.Id_SERG, Sum(diario.HABER) AS SumaDeHABER, pcge.DOSDIGITOS
FROM diario INNER JOIN pcge ON diario.CTA_CONT = pcge.ID_CTA
GROUP BY diario.ID_OPERA, diario.Id_SERG, pcge.DOSDIGITOS
HAVING (((diario.ID_OPERA)='$OP') AND ((diario.Id_SERG)='$RD') AND ((pcge.DOSDIGITOS)=14));


  ";
  $resultS = mysqli_query($conexion, $queryS);
  $filasS=mysqli_fetch_assoc($resultS);
  $SUMA=$filasS ['SumaDeHABER']; 




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
      <h5><span class="icon-folder-open "></span> GASTOS REALIZADOS - <?php echo $NOMBREOP ?> - S/<?php echo $SUMA ?> </h5>
      <div class="form-container text-right">

        <a href="rd_diario_creategasto.php?rd=<?php echo $RD ?>&op=<?php echo $OP ?>" style="color: white ;" type="button" class="btn btn-success mb-2">
          <span class="icon-plus "></span> NUEVO
        </a>
        &nbsp
        <a href="rd_operadores_read.php?rd=<?php echo $RD ?>" style="color: white ;" type="button" class="btn btn-secondary mb-2">
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
      <th scope="col">FECHA</th>
      <th scope="col">TIPO</th>
      <th scope="col">DESCRIPCION</th>
      <th scope="col">IMPORTE</th>
      <th scope="col">OPCIONES</th>
    </tr>
  </thead>
  <tbody>
   
      <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      <tr>       
      <td>
        <?php echo $filas ['FECHA_DOC']  ?>
      </td>
      <td>
        <?php echo $filas ['CTA_NOMBRE']  ?> 
      </td>
      <td>
        <?php echo $filas ['GLOSA']  ?>  
      </td>
      <td class="text-align">
        <?php echo $filas ['HABER']  ?> 

    
      <td> 
          <a href="crud_diario/delete.php?id=<?php echo $filas ['ID_DIARIO']?>&rd=<?php echo $RD ?>&op=<?php echo $OP ?>" class="btn btn-danger"> 
          <span class="icon-bin"></span>
          </a>

          <a href="rd_diario_createGAS.php?rd=<?php echo $RD ?>&op=<?php echo $OP ?>&id=<?php echo $filas ['ID_DIARIO'] ?>" class="btn btn-primary"> 
          <span class="icon-pencil2"></span>
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