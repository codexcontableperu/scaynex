<?php include("../data/conexion.php"); ?>
<?php include('includes/header_datatables.php'); ?>
<?php include('whatsaap.php'); ?>
<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="whatsaap/stilo_pag.css">

    <div class="pagina-centrada">
        <!-- Contenido de la página aquí -->

<?php
$tabla = 'rd_operadores';

if (isset($_GET['f'])) {
  $FECHA = $_GET['f'];

  // Crear la consulta
  $query = "
SELECT rd_operadores.*, rd_segimientos_head.S_FECHA, usuarios.user_avatar
FROM (rd_operadores INNER JOIN rd_segimientos_head ON rd_operadores.Id_SERG = rd_segimientos_head.Id_SERG) LEFT JOIN usuarios ON rd_operadores.NOMBRE = usuarios.user_nombre
WHERE (((rd_segimientos_head.S_FECHA)='$FECHA'))
ORDER BY rd_operadores.NOMBRE

;

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

table {
    font-size: 11px; /* Puedes ajustar el tamaño según tus preferencias */
}
cabeza{
background: red;
}

img {
      border-radius: 50%;
      height: 80px;
      width: 80px;
      margin-right: 10px;
    }
    .nick {
      color: white;
      
      padding-left: 10px;
      padding-right: 10px;
      background: grey ;
      border-radius: 10px;
    }

input {
    width: 70px; /* Ancho  */
  }
</style>
<div class="container">
  <div class="row">
    <div class="col-sm">
      <h6><span class="icon-folder-open "></span> PERSONAL ASIGNADO AL SERVICIO</h6>

    </div>
  </div>
</div>

<div class="dropdown-divider"></div> 


<div class="container">
  <div class="row">
    <div class="col-sm">

<table id="example" class="table table-striped table-sm">

  <tbody>
  
      <?php while($filas=mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td class="text-center">
<form action="crud_operadores/update.php" method="POST">
<input type="hidden"  class="form-control" id="id" name="id" value="<?php echo $filas ['ID_OPERA'] ?>" >    
<input type="hidden"  class="form-control" id="FECHA" name="FECHA" value="<?php echo $FECHA ?>" >        
        <img src="../panel/<?php echo $filas ['user_avatar'] ; ?>" alt="foto"  ><br>
        <?php echo $filas ['NOMBRE']  ?> <br>
        (<?php echo $filas ['TIPO_OP']  ?>) <br>
        <?php 
         $EFEC = $filas ['EFECTIVO'];
         $YAPE = $filas ['YAPE'];
         $PLIN = $filas ['PLIN'];
         $OTRO = $filas ['OTROEF'];
         $TOTAL = $EFEC +$YAPE+$PLIN +$OTRO ;
        ?>
        TOTAL:<?php echo number_format($TOTAL, 2) ?>
      </td>
<td>

    
        
EFECTIVO:<br><input type="number" id="EFECTIVO" name="EFECTIVO" value="<?php echo $filas ['EFECTIVO']  ?>" > 
        <br>
YAPE:<br><input type="number" id="YAPE" name="YAPE" value="<?php echo $filas ['YAPE']  ?>" >
        <br>        
PLIN:<br><input type="number" id="PLIN" name="PLIN" value="<?php echo $filas ['PLIN']  ?>" >
        <br> 
OTRO:<br><input type="number" id="OTROEF" name="OTROEF" value="<?php echo $filas ['OTROEF']  ?>">
        <br> 

</td>

      <td>

    <button type="submit" id="guardar" name="guardar" class="btn btn-primary btn-sm "><span class=" icon-floppy-disk "></span></button>
       </td>     
      </tr>
      </form> 
    <?php } ?>
  
  </tbody>
</table>




    </div>
  </div>
</div>

<?php
}
?>



<?php include('includes/footer_datatables.php'); ?>