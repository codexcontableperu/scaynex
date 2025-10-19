<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
<?php include("../data/conexion.php"); ?>

<?php


     $query="
SELECT head_programaciones.hora_cita, head_programaciones.id_head, head_programaciones.head_fecha, head_programaciones.head_nombre, clientes.cte_nombrecomercial, head_programaciones.fechareg, clientes.cte_logo
FROM head_programaciones INNER JOIN clientes ON head_programaciones.id_cliente = clientes.id_cliente
WHERE (((head_programaciones.fechareg)='$hoy'))

				";
     $result=mysqli_query($conexion, $query);




?>

<?/*---cabeseras de la tabla---*/?>

<table class="table table-sm table-bordered text-center  " >
  <thead class="thead-dark">
    <tr>
      <th scope="col">OTR</th> 
      <th scope="col">FECHA</th>     
      <th scope="col">CLIENTE</th>
      <th scope="col">CUENTAS</th>
    </tr>
  </thead>

  <?/*---contenido de la tabla---*/?>


  <tbody>

	<?php while($filas=mysqli_fetch_assoc($result)) { ?>
	    <tr>
	      <td>    
	      	<span class="icon-files-empty"></span>000<?php echo $filas ['id_head'];?><br>
	      <a href="head_create_read.php?id=<?php echo $filas ['id_head']?>" class="btn btn-success"> 
	        <span class="icon-pencil"></span>
	    	</a> 

	      <a href="head_delete.php?id=<?php echo $filas ['id_head']?>" class="btn btn-danger"> 
					<span class="icon-bin"></span>
	      	</a>
	      </td>

	      <td>
                  <?php echo $filas ['head_fecha'];?><br>
               <span class="icon-clock"></span> <?php echo $filas ['hora_cita'];?> <br>

	      	
	      </td>

	      <td>
	      	<img loading="lazy" src="../panel/<?php echo $filas ['cte_logo'];?>" width="80" heigth="80" >
	      	<br>
	      	<?php echo $filas ['cte_nombrecomercial'];?>
	      </td>


	     <td>

			<div class="container text-center ">

	      <a href="prog_create_read.php?id=<?php echo $filas ['id_head']?>" class="btn btn-primary"> 
	        <span class="icon-folder-plus"></span>
	    	</a>

			</div>

	     </td>
	    </tr>
	 <?php } ?>

  </tbody>
</table>

<div class="card">
  <div class="card-body">

<a href="head_print.php" class="btn btn-primary btn-lg btn-block"> 
          <span class="icon-printer"></span>
        </a>
  </div>
</div>

<?php include('includes/footer.php'); ?>