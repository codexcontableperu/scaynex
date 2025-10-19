<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="style.css">
<?php include("../data/conexion.php"); ?>

<?php

$id_head = $_GET['id'];

     $query="

     SELECT programaciones.id_prog, programaciones.id_head, cuentas.cta_logo, cuentas.cta_nombrecomercial, unidades.vh_placa AS asignado, unidades_1.vh_placa AS reportado, usuarios.user_nick AS conductor, usuarios_1.user_nick AS ayudante, programaciones.cant_estiva, tipo_prog.tprog_nombre, programaciones.obs_prog
FROM (((((programaciones INNER JOIN cuentas ON programaciones.id_cta = cuentas.id_cta) INNER JOIN unidades ON programaciones.vh_asignado = unidades.id_vh) INNER JOIN unidades AS unidades_1 ON programaciones.vh_reportado = unidades_1.id_vh) INNER JOIN usuarios ON programaciones.id_conductor = usuarios.id_user) INNER JOIN usuarios AS usuarios_1 ON programaciones.id_ayudante = usuarios_1.id_user) INNER JOIN tipo_prog ON programaciones.id_tprog = tipo_prog.id_tprog
WHERE (((programaciones.id_head)=$id_head))

				";
     $result=mysqli_query($conexion, $query);

?>

<?/*---cabeseras de la tabla---*/?>

<table class="table table-sm table-bordered text-center " >
  <thead class="thead-dark ">
    <tr>

      
      <th scope="col">CUENTA</th>
      <th scope="col">VEHICULO</th>
      <th scope="col">OPERADORES</th>
      <th scope="col">OBSERVACIONES</th>
      <th scope="col">ACCIONES</th>

    </tr>
  </thead>

  <?/*---contenido de la tabla---*/?>


  <tbody>

	<?php while($filas=mysqli_fetch_assoc($result)) { ?>
	    <tr>
	      
	      <td >
	      	<img loading="lazy" src="../panel/<?php echo $filas ['cta_logo'];?>" width="60" heigth="60" >
	      	<br>
	      	<?php echo $filas ['cta_nombrecomercial'];?>
	      	<br>
	      	<?php echo $filas ['tprog_nombre'];?>
	      </td>

	      <td align="left" >
	      	V.A: <?php echo $filas ['asignado'];?> <br>
	      	V.R: <?php echo $filas ['reportado'];?>

	      </td>

	      <td align="left" >
	      	CON: <?php echo $filas ['conductor'];?> <br>
	      	AYU: <?php echo $filas ['ayudante'];?> <br>
	      	EST: <?php echo $filas ['cant_estiva'];?>
	      </td>

	      <td >
				<?php echo $filas ['obs_prog'];?>
	       </td>

	     <td>

			<div class="container text-center ">
		    <a href="prog_update.php?id=<?php echo $filas ['id_prog']?>&cta=<?php echo $id_head ?>" class="btn btn-primary"> 
	        <span class="icon-checkmark"></span>
	    	</a>

	      <a href="prog_delete.php?id=<?php echo $filas ['id_prog']?>&cta=<?php echo $id_head ?>" class="btn btn-danger"> 
					<span class="icon-bin"></span>
	      	</a>

			</div>

	     </td>
	    </tr>
	 <?php } ?>

  </tbody>
</table>

<div class="card">
  <div class="card-body">

<a href="head_print2.php?id=<?php echo $_GET['id'];?>" class="btn btn-success btn-lg btn-block"> 
          <span class="icon-printer"></span>
        </a>
  </div>
</div>

<?php include('includes/footer.php'); ?>