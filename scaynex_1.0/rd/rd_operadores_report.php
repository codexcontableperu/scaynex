

<?php
$tabla = 'rd_operadores';

  // Crear la consulta
  $query1 = "SELECT * FROM rd_operadores ";
  $result1 = mysqli_query($conexion, $query1);
  $filas1=mysqli_fetch_assoc($result1);
  $s= $filas1 ['CONDUCTOR'];
  echo $s;
  die();

// Generar tabla
?>


<div class="container">
  <div class="row">
    <div class="col-sm">

<table id="example" class="table table-striped table-sm">
  <thead  class="thead-dark">
    <tr>
      <th scope="col">CONDUCTOR</th>
      <th scope="col">AUXILIAR1</th>
      <th scope="col">AUXILIAR2</th>
      <th scope="col">AUXILIAR3</th>
      <th scope="col">EFECTIVO</th>
      <th scope="col">YAPE</th>
      <th scope="col">PLIN</th>
      <th scope="col">OTROEF</th>
      <th scope="col">TOTALEFECTIVO</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  
      <?php while($filas=mysqli_fetch_assoc($result)) { ?>
      <tr>       

      <td>
        <?php echo $filas ['CONDUCTOR']  ?> 
      </td>
      <td>
        <?php echo $filas ['AUXILIAR1']  ?> 

      </td>
      <td>
        <?php echo $filas ['AUXILIAR2']  ?>

      </td>
      <td>
        <?php echo $filas ['AUXILIAR3']  ?>

      </td>
      <td>
        <?php echo $filas ['EFECTIVO']  ?>

      </td>
      <td>
        <?php echo $filas ['YAPE']  ?>

      </td>
      <td>
        <?php echo $filas ['PLIN']  ?>

      </td>
      <td>
        <?php echo $filas ['OTROEF']  ?>

      </td>
      <td>
        <?php echo $filas ['TOTALEFECTIVO']  ?>

      </td>
     
      </tr>
    <?php } ?>
  
  </tbody>
</table>




    </div>
  </div>
</div>
