<?php include("../data/conexion.php"); ?>
<link rel="stylesheet" href="stylos/stylos.css">
<link rel="stylesheet" href="efectos.css">
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>


   <?/*---formulario tabla---*/?>
<?php
$tabla = 'rd_gastos';

if (isset($_GET['rd'])) {
  $RD = $_GET['rd'];

  // Crear la consulta
  $query = "SELECT * FROM $tabla WHERE Id_SERG='$RD'";
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
      <h5><span class="icon-folder-open "></span> GASTOS DIVERSOS</h5>
      <div class="form-container text-right">

        <a href="<?php echo $tabla ?>_create.php?rd=<?php echo $RD ?>" style="color: white ;" type="button" class="btn btn-success mb-2">
          <span class="icon-plus "></span> NUEVO
        </a>
        &nbsp
        <a href="segimientos_read.php?f=<?php echo $FECHAW ?>" style="color: white ;" type="button" class="btn btn-secondary mb-2">
          <span class="icon-reply "></span> CERRAR
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
      <th scope="col">G_FECHA</th>
      <th scope="col">G_TIPO</th>
      <th scope="col">DESCRIPCION</th>
      <th scope="col">IMPORTE</th>
      <th scope="col">OPCIONES</th>
    </tr>
  </thead>
  <tbody>
   
      <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      <tr>       
      <td>
        <?php echo $filas ['G_FECHA']  ?>
      </td>
      <td>
        <?php echo $filas ['G_TIPO']  ?> 
      </td>
      <td>
        <?php echo $filas ['DESCRIPCION']  ?> 

      </td>
      <td>
        <?php echo $filas ['IMPORTE']  ?>

      </td>
      
      <td> 
          <a href="crud_tablas/delete.php?id=<?php echo $filas ['ID_GASTO']?>&rd=<?php echo $RD ?>&t=<?php echo $tabla ?>" class="btn btn-danger"> 
          <span class="icon-bin"></span>
          </a>
          <a href="<?php echo $tabla ?>_create.php?id=<?php echo $filas ['ID_GASTO'] ?>&rd=<?php echo $RD ?>" class="btn btn-primary"> 
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