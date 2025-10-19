<?php include("../data/conexion.php"); ?>
<?php include('includes/header.php'); ?>
<?php include('includes/menubar.php'); ?>
<?php

if (isset($_POST['id'])) {
  $ID = $_POST['id'];
} else  {
  $ID = $_GET['id'];
}


$query="
SELECT rd_segimientos_head.*, usuarios.user_nombre
FROM usuarios INNER JOIN rd_segimientos_head ON usuarios.Id_USER = rd_segimientos_head.S_USER
WHERE (((rd_segimientos_head.Id_SERG)='$ID'));
";
$result=mysqli_query($conexion, $query);
$filas=mysqli_fetch_assoc($result);
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
    <span class="icon-truck"></span> REPORTE DIARIO - CONTROL DE UNIDAD <?php echo $filas ['PLACA']; ?>
    </B></h4>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm">

<div class="dropdown-divider"></div> 
<table class="table table-bordered">
  <tbody>
    <tr>
      <th scope="row">FECHA SALIDA</th>
      <td><?php echo $filas ['S_FECHA']; ?></td>
      <th scope="row">PLACA</th>
      <td><?php echo $filas ['PLACA']; ?></td>
      <th scope="row">USUARIO</th>
      <td><?php echo $filas ['user_nombre']; ?></td>
      <th scope="row">REGISTRADO</th>
      <td><?php echo $filas ['REGISTER']; ?></td>  
    </tr>
  </tbody>
</table>
    </div>
  </div>
</div>

<div class="dropdown-divider"></div> 

<!-- tabla rd_servicio -->

<div class="container">
  <div class="row">
    <div class="col-sm">

<?php
$t = 'rd_servicio';
$query2 = "SELECT * FROM $t WHERE Id_SERG ='$ID' ";
$result2 = mysqli_query($conexion, $query2);
$tabla = $t;
$query = "SHOW KEYS FROM $tabla WHERE Key_name = 'PRIMARY'";
$result = mysqli_query($conexion, $query);
// Obtener el nombre de la columna de índice primario
$indice = '';
while ($row = mysqli_fetch_assoc($result)) {
    $indice = $row['Column_name'];
    break;  // Tomamos la primera columna de la clave primaria
}
?>

<!-- Cabeceras de la tabla -->

<h5><span class="icon-truck "></span> DATOS DE LA UNIDAD:</h5>

<br>
<table class="table table-sm table-hover">
  <thead class="table-light">
    <tr>
      <?php
      // Mostrar las cabeceras de las columnas de la tabla
      $result = mysqli_query($conexion, "DESCRIBE $tabla");
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<th>' . $row["Field"] . '</th>';
      }
      ?>
    </tr>
  </thead>
  <!-- Contenido de la tabla -->
  <tbody>
    <?php while ($filas = mysqli_fetch_assoc($result2)) { ?>
      <tr>
        <?php foreach ($filas as $campo) { ?>
          <td><?php echo $campo; ?></td>
        <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
</table>

    </div>
  </div>
</div>









<div class="dropdown-divider"></div> 

<!-- tabla rd_servicio -->

<div class="container">
  <div class="row">
    <div class="col-sm">

<?php
$t = 'rd_operadores';
$query2 = "SELECT * FROM $t WHERE Id_SERG ='$ID' ";
$result2 = mysqli_query($conexion, $query2);
$tabla = $t;
$query = "SHOW KEYS FROM $tabla WHERE Key_name = 'PRIMARY'";
$result = mysqli_query($conexion, $query);
// Obtener el nombre de la columna de índice primario
$indice = '';
while ($row = mysqli_fetch_assoc($result)) {
    $indice = $row['Column_name'];
    break;  // Tomamos la primera columna de la clave primaria
}
?>

<!-- Cabeceras de la tabla -->

<h5><span class="icon-user-tie  "></span> DATOS DEL PERSONAL ASIGNADO:</h5>

<br>
<table class="table table-sm table-hover">
  <thead class="table-light">
    <tr>
      <?php
      // Mostrar las cabeceras de las columnas de la tabla
      $result = mysqli_query($conexion, "DESCRIBE $tabla");
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<th>' . $row["Field"] . '</th>';
      }
      ?>
    </tr>
  </thead>
  <!-- Contenido de la tabla -->
  <tbody>
    <?php while ($filas = mysqli_fetch_assoc($result2)) { ?>
      <tr>
        <?php foreach ($filas as $campo) { ?>
          <td><?php echo $campo; ?></td>
        <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
</table>

    </div>
  </div>
</div>







<div class="dropdown-divider"></div> 

<!-- tabla rd_servicio -->

<div class="container">
  <div class="row">
    <div class="col-sm">

<?php
$t = 'rd_combustible';
$query2 = "SELECT * FROM $t WHERE Id_SERG ='$ID' ";
$result2 = mysqli_query($conexion, $query2);
$tabla = $t;
$query = "SHOW KEYS FROM $tabla WHERE Key_name = 'PRIMARY'";
$result = mysqli_query($conexion, $query);
// Obtener el nombre de la columna de índice primario
$indice = '';
while ($row = mysqli_fetch_assoc($result)) {
    $indice = $row['Column_name'];
    break;  // Tomamos la primera columna de la clave primaria
}
?>

<!-- Cabeceras de la tabla -->

<h5><span class="icon-lab"></span> CONSUMOS DE COMBUSTIBLE:</h5>

<br>
<table class="table table-sm table-hover">
  <thead class="table-light">
    <tr>
      <?php
      // Mostrar las cabeceras de las columnas de la tabla
      $result = mysqli_query($conexion, "DESCRIBE $tabla");
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<th>' . $row["Field"] . '</th>';
      }
      ?>
    </tr>
  </thead>
  <!-- Contenido de la tabla -->
  <tbody>
    <?php while ($filas = mysqli_fetch_assoc($result2)) { ?>
      <tr>
        <?php foreach ($filas as $campo) { ?>
          <td><?php echo $campo; ?></td>
        <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
</table>

    </div>
  </div>
</div>








<div class="dropdown-divider"></div> 

<!-- tabla rd_servicio -->

<div class="container">
  <div class="row">
    <div class="col-sm">

<?php
$t = 'rd_gastos';
$query2 = "SELECT * FROM $t WHERE Id_SERG ='$ID' ";
$result2 = mysqli_query($conexion, $query2);
$tabla = $t;
$query = "SHOW KEYS FROM $tabla WHERE Key_name = 'PRIMARY'";
$result = mysqli_query($conexion, $query);
// Obtener el nombre de la columna de índice primario
$indice = '';
while ($row = mysqli_fetch_assoc($result)) {
    $indice = $row['Column_name'];
    break;  // Tomamos la primera columna de la clave primaria
}
?>

<!-- Cabeceras de la tabla -->

<h5> <span class=" icon-stats-dots "></span> REGISTRO DE GASTOS REALIZADOS:</h5>

<br>
<table class="table table-sm table-hover">
  <thead class="table-light">
    <tr>
      <?php
      // Mostrar las cabeceras de las columnas de la tabla
      $result = mysqli_query($conexion, "DESCRIBE $tabla");
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<th>' . $row["Field"] . '</th>';
      }
      ?>
    </tr>
  </thead>
  <!-- Contenido de la tabla -->
  <tbody>
    <?php while ($filas = mysqli_fetch_assoc($result2)) { ?>
      <tr>
        <?php foreach ($filas as $campo) { ?>
          <td><?php echo $campo; ?></td>
        <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
</table>

    </div>
  </div>
</div>






<div class="dropdown-divider"></div> 

<!-- tabla rd_servicio -->

<div class="container">
  <div class="row">
    <div class="col-sm">

<?php
$t = 'rd_recorrido';
$query2 = "SELECT * FROM $t WHERE Id_SERG ='$ID' ";
$result2 = mysqli_query($conexion, $query2);
$tabla = $t;
$query = "SHOW KEYS FROM $tabla WHERE Key_name = 'PRIMARY'";
$result = mysqli_query($conexion, $query);
// Obtener el nombre de la columna de índice primario
$indice = '';
while ($row = mysqli_fetch_assoc($result)) {
    $indice = $row['Column_name'];
    break;  // Tomamos la primera columna de la clave primaria
}
?>

<!-- Cabeceras de la tabla -->

<h5>  <span class=" icon-road "></span>  CONTROL DE ENTREGAS A CLIENTE:</h5>

<br>
<table class="table table-sm table-hover">
  <thead class="table-light">
    <tr>
      <?php
      // Mostrar las cabeceras de las columnas de la tabla
      $result = mysqli_query($conexion, "DESCRIBE $tabla");
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<th>' . $row["Field"] . '</th>';
      }
      ?>
    </tr>
  </thead>
  <!-- Contenido de la tabla -->
  <tbody>
    <?php while ($filas = mysqli_fetch_assoc($result2)) { ?>
      <tr>
        <?php foreach ($filas as $campo) { ?>
          <td><?php echo $campo; ?></td>
        <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
</table>

    </div>
  </div>
</div>







<div class="dropdown-divider"></div> 

<!-- tabla rd_servicio -->

<div class="container">
  <div class="row">
    <div class="col-sm">

<?php
$t = 'rd_facturacion';
$query2 = "SELECT * FROM $t WHERE Id_SERG ='$ID' ";
$result2 = mysqli_query($conexion, $query2);
$tabla = $t;
$query = "SHOW KEYS FROM $tabla WHERE Key_name = 'PRIMARY'";
$result = mysqli_query($conexion, $query);
// Obtener el nombre de la columna de índice primario
$indice = '';
while ($row = mysqli_fetch_assoc($result)) {
    $indice = $row['Column_name'];
    break;  // Tomamos la primera columna de la clave primaria
}
?>

<!-- Cabeceras de la tabla -->

<h5> <span class=" icon-clipboard  "></span> DATOS DE FACTURACION:</h5>

<br>
<table class="table table-sm table-hover">
  <thead class="table-light">
    <tr>
      <?php
      // Mostrar las cabeceras de las columnas de la tabla
      $result = mysqli_query($conexion, "DESCRIBE $tabla");
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<th>' . $row["Field"] . '</th>';
      }
      ?>
    </tr>
  </thead>
  <!-- Contenido de la tabla -->
  <tbody>
    <?php while ($filas = mysqli_fetch_assoc($result2)) { ?>
      <tr>
        <?php foreach ($filas as $campo) { ?>
          <td><?php echo $campo; ?></td>
        <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
</table>

    </div>
  </div>
</div>






<div class="dropdown-divider"></div> 

<!-- tabla rd_servicio -->

<div class="container">
  <div class="row">
    <div class="col-sm">

<?php
$t = 'rd_responsables';
$query2 = "SELECT * FROM $t WHERE Id_SERG ='$ID' ";
$result2 = mysqli_query($conexion, $query2);
$tabla = $t;
$query = "SHOW KEYS FROM $tabla WHERE Key_name = 'PRIMARY'";
$result = mysqli_query($conexion, $query);
// Obtener el nombre de la columna de índice primario
$indice = '';
while ($row = mysqli_fetch_assoc($result)) {
    $indice = $row['Column_name'];
    break;  // Tomamos la primera columna de la clave primaria
}
?>

<!-- Cabeceras de la tabla -->

<h5><span class=" icon-list-numbered  "></span> DATOS DE SEGUIMIENTO POST-VENTA:</h5>

<br>
<table class="table table-sm table-hover">
  <thead class="table-light">
    <tr>
      <?php
      // Mostrar las cabeceras de las columnas de la tabla
      $result = mysqli_query($conexion, "DESCRIBE $tabla");
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<th>' . $row["Field"] . '</th>';
      }
      ?>
    </tr>
  </thead>
  <!-- Contenido de la tabla -->
  <tbody>
    <?php while ($filas = mysqli_fetch_assoc($result2)) { ?>
      <tr>
        <?php foreach ($filas as $campo) { ?>
          <td><?php echo $campo; ?></td>
        <?php } ?>
      </tr>
    <?php } ?>
  </tbody>
</table>

    </div>
  </div>
</div>




<?php include('includes/footer.php'); ?>